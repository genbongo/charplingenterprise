<?php

namespace App\Http\Controllers;

use App\Notification;
use App\{Area, User, Product, Order};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Helpers\Mail\SenderHelper as MailDispatch;
use App\SystemNotification;
use App\Traits\GlobalFunction;
class NotificationController extends Controller
{
    use GlobalFunction;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = User::select('users.id')
                    ->join('order_invoice', ['order_invoice.user_id' => 'users.id'])
                    ->groupBy('order_invoice.user_id')
                            ->pluck('id')
                                ->toArray();

        $deactivate =  User::where('user_role',2)
                    ->whereRaw("created_at <= DATE_SUB(NOW(), INTERVAL 60 DAY)")
                    ->where('is_active',1)
                    ->whereNotIn('id', $orders)
                    ->get();

        foreach ($deactivate as $key => $value) {
            User::whereId($value->id)->update([
                'is_active' => 0
            ]);
        }            
    
        $orders = Order::selectRaw('orders.*,order_invoice.invoice_no')
            ->where('orders.is_approved', 1)
            ->join('order_invoice', ['orders.invoice_id' => 'order_invoice.id'])
                    ->where('orders.is_completed', 0)
                    ->where('is_cancelled',0)
                        ->whereRaw("delivery_date < CURDATE()")
                            ->get();

                        // return $orders;
        foreach ($orders as $key => $value) {
            Order::whereId($value->id)->update([
                'is_cancelled' => 1
            ]);
            if($user = User::find($value->client_id)){
                //staff
                $this->notificationDispatch([
                    'user_id'   => $user->id,
                    'type'      => 'order_auto_cancel',
                    'area_id'   => $user->area_id,
                    'email_to'  => 'staff',
                    'message'   => "There are ".count($orders)." orders that were automatically cancelled and added to the undelivered list. It has
                    passed the delivery date and no actions were done. Please contact your administration for
                    clarification.",
                    'status'    => 'unread'
                ]);   
                //client
                $this->notificationDispatch([
                    'user_id'   => $user->id,
                    'type'      => 'order_auto_cancel',
                    'area_id'   => $user->area_id,
                    'email_to'  => 'client',
                    'message'   => "Your order ".$value->invoice_no." is added to the undelivered list. It has passed the delivery date.
                    Please contact the staff assigned in your store area",
                    'status'    => 'unread'
                ]);   

                //set text message
                $text_message = "Your order ".$value->invoice_no." is added to the undelivered list.\nIt has passed the delivery date.\nPlease contact the staff assigned in your store area 
                \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

                //send it to customer
                $this->global_itexmo($user->contact_num, $text_message, "ST-CHARP371478_AF72H", '7x8j1z3vnv');
            }
        }
        $users = User::where('is_pending','0')
                        ->where('is_active','1')
                            ->where('user_role',2)
                                ->where('expiry', '<=',  date("Y-m-d"))
                                    ->where('sent', 0)
                                        ->get();
        // return response()->json($users);
        foreach ($users as $key => $value) {
            //client reminder
            $this->notificationDispatch([
                'user_id'   => $value->id,
                'type'      => 'reminder_client',
                'area_id'   => $value->area_id,
                'email_to'  => 'client',
                'message'   => "Hi, " .$value->fname. ". <br> We’ve noticed you don’t have any transactions with us for 2 months. <br/> Please be reminded that you will be deactivated in 7 days if the situation is still the same.",
                'status'    => 'unread'
            ]);   
            //staff reminder
            $this->notificationDispatch([
                'user_id'   => $value->id,
                'type'      => 'reminder_staff',
                'area_id'   => $value->area_id,
                'email_to'  => 'staff',
                'message'   => "(" . $value->id . ") " . $value->fname. " ". $value->lname . " will be deactivated in 7 days if there is still no transaction made. Please follow up client. ",
                'status'    => 'unread'
            ]);   
            //admin reminder
            $this->notificationDispatch([
                'user_id'   => $value->id,
                'type'      => 'reminder_admin',
                'area_id'   => $value->area_id,
                'email_to'  => 'admin',
                'message'   => "(" . $value->id . ") " . $value->fname. " ". $value->lname . " has not ordered for two months. He will be deactivated in 7 days. Please set date for refrigerator pull out.",
                'status'    => 'unread'
            ]);   

            //set text message
            $text_message = "Hi, ". $value->fname . "\n \nWe’ve noticed you don’t have any transactions with us for 2 months. Please be reminded that you will be deactivated in 7 days if the situation is still the same. 
            \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

            //send it to customer
            $this->global_itexmo($value->contact_num, $text_message, "ST-CHARP371478_AF72H", '7x8j1z3vnv');

            new MailDispatch('reminder', trim($value->email), array(
                'subject'   => 'Reminder of 2 months without ordering',
                'title'     => 'Reminder of 2 months without ordering', 
                "site"      => '',
                "name"      => trim($value->fname)
            ));

            User::whereId($value->id)->update(['sent' => 1]);
        }


        if(Auth::user()->user_role == 99){
            //product stocks
            $stocks = Product::join('product_stocks', ['products.id' => 'product_stocks.product_id'])
                            ->selectRaw('products.id, product_stocks.id as product_stock_id, products.name as product_name, product_stocks.size, product_stocks.quantity, product_stocks.threshold')
                                ->where('product_stocks.status', 0)        
                                ->get();
                                
            foreach ($stocks as $key => $stock) {
                
                if($stock->quantity == 0){
                    //admin reminder
                    $this->notificationDispatch([
                        'user_id'           => 0,
                        'type'              => 'out_of_stock',
                        'area_id'           => 0,
                        'product_id'        => $stock->id,
                        'product_stock_id'  => $stock->product_stock_id,
                        'email_to'          => 'admin',
                        'message'           => $stock->product_name . " ". $stock->size. " is out of stock. Please re-stock as soon as possible.",
                        'status'            => 'unread',
                    ]);   
                } elseif($stock->quantity != 0 && $stock->quantity <= $stock->threshold){
                    //admin reminder
                    $this->notificationDispatch([
                        'user_id'           => 0,
                        'type'              => 'running_out_stock',
                        'area_id'           => 0,
                        'product_id'        => $stock->id,
                        'product_stock_id'  => $stock->product_stock_id,
                        'email_to'          => 'admin',
                        'message'           => $stock->product_name . " ". $stock->size. " has reached the stock threshold. Please re-stock as soon as possible.",
                        'status'            => 'unread'
                    ]);   
                } 
            }                    
            //check todays registered
            $users        = User::select('id')->whereRaw('Date(created_at) = CURDATE() AND user_role = 2')->get()->count(); 
            $notification = SystemNotification::select('id','message')->where('email_to', 'admin')->orderBy('id', 'desc')->get();
            if($users > 0){
                $notification  = array_merge($notification->toArray(),array(
                    ['id' => 0, 
                    'message' => "There are ".$users." registrations for today. <a href='/client'>Click</a> to review details"]
                ));
            }
            
        } 
        else if(Auth::user()->user_role == 2){#client notifications
            $user = User::find(@Auth::user()->id);
            $notification = SystemNotification::where('user_id', $user->id)->where('email_to', 'client')->orderBy('id', 'desc')->get();
            // return response()->json($notification);
        } 
        else { //staff notifications
            $user = User::find(@Auth::user()->id);
            $notification = SystemNotification::where('area_id', $user->area_id)->where('email_to', 'staff')->orderBy('id', 'desc')->get();
            // return response()->json($notification);
        }

        $users = User::where('is_pending','0')->where('is_active','1')->get();

        if(!DB::table('notification_counter')->where('user_id',Auth::user()->id)->first()){
            DB::table('notification_counter')->updateOrInsert(
                [
                    'current_notif' => count($notification),
                    'updated_notif' => count($notification)
                ],
                ['user_id' => Auth::user()->id]
            );
        } else {
            DB::table('notification_counter')->updateOrInsert(
                [
                    'current_notif' => count($notification)
                ],
                ['user_id' => Auth::user()->id]
            );
        }

        if($notif = DB::table('notification_counter')->where('user_id',Auth::user()->id)->first()){
            if($notif->modified){
                $counter = $notif->current_notif - $notif->updated_notif;
            } else {
                $counter = $notif->current_notif;
            }
        }
        
        return response()->json(['notifications' => $notification, 'counter' => ($counter > 0) ? $counter : 0 ]);
    }

    public function notificationUpdate(Request $request){
        if($notif = DB::table('notification_counter')->where('user_id',Auth::user()->id)->first()){
           $updated_notif = $notif->updated_notif + $request->updated_notif;
            DB::table('notification_counter')
                ->where('user_id',Auth::user()->id)
                    ->update(['modified' => date('Y-m-d'),'updated_notif' => $updated_notif]);

        }
    }
}
