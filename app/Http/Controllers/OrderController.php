<?php

namespace App\Http\Controllers;

use App\{Order,User,ProductStock};
// use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Mail\SenderHelper as MailDispatch;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Traits\GlobalFunction;

class OrderController extends Controller
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
     * @desc get pending orders item
     */

    public function pendingOrder(Request $request){
        if ($request->ajax()) {
            if($request->type == 'all'){
                $pending = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered','orders.size',
                    'orders.ordered_total_price', 'orders.created_at', 
                    'orders.is_approved', 'orders.is_completed', 
                    'orders.delivery_date', 
                    'orders.id', 
                    'users.fname', 
                    'users.lname', 
                    'users.contact_num',
                    'orders.product_stock_id',
                    'orders.client_id')
                // ->where('orders.is_approved', $request->setId)
                ->where('orders.invoice_id', $request->invoice_id)
                ->get()
                ->map(function($item){
                    $item->remaining_stock = 0 ;
                    if($stock = ProductStock::whereId($item->product_stock_id)->first()){
                        $item->remaining_stock = $stock->quantity;
                    }
                    return $item;
                });
            } else {
                $pending = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                ->select('products.id AS prodID', 
                'products.name', 
                'products.product_image', 
                'orders.quantity_ordered',
                'orders.size',
                'orders.ordered_total_price', 
                'orders.created_at', 
                'orders.is_approved', 
                'orders.is_completed', 
                'orders.delivery_date', 
                'orders.id', 
                'users.fname', 
                'users.lname', 
                'users.contact_num', 
                'orders.product_stock_id',
                'orders.client_id')
                ->where('orders.is_approved', $request->setId)
                ->where('orders.invoice_id', $request->invoice_id)
                ->get()
                ->map(function($item){
                    $item->remaining_stock = 0 ;
                    if($stock = ProductStock::whereId($item->product_stock_id)->first()){
                        $item->remaining_stock = $stock->quantity;
                    }
                    return $item;
                });
            }
            

            return response()->json($pending, 200);
        }
    }

    /**
     * @desc get orders item
     */

    public function completedOrder(Request $request){
        if ($request->ajax()) {
            $order_history = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                ->select('products.id AS prodID',
                    'products.name', 'products.product_image',
                    'orders.quantity_ordered','orders.size',
                    'orders.ordered_total_price',
                    'orders.created_at',
                    'orders.is_approved',
                    'orders.is_completed',
                    'orders.delivery_date',
                    'orders.id',
                    'users.fname',
                    'users.lname',
                    'users.contact_num',
                    'orders.client_id')
                ->where('orders.invoice_id', $request->invoice_id)
                ->get();

            return response()->json($order_history, 200);
        }
    }

    /**
     * @desc get orders item
     */

    public function cancelOrder(Request $request){
        if ($request->ajax()) {

            if($user = User::selectRaw('users.*,order_invoice.invoice_no')
                        ->join('order_invoice', ['order_invoice.user_id' => 'users.id'])->first()){
                //client reminder
                $this->notificationDispatch([
                    'user_id'   => $user->id,
                    'type'      => 'admin_cancel_order',
                    'area_id'   => $user->area_id,
                    'email_to'  => 'client',
                    'message'   => "Your order ".$user->invoice_no." was cancelled by the admin in the undelivered list. Please contact
                    the staff assigned in your store area.",
                    'status'    => 'unread'
                ]);  
                //set text message
                $text_message = "Your order ".$user->invoice_no." was cancelled by the admin in the undelivered list.\nPlease contact the staff assigned in your store area.           
                \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

                //send it to customer
                $this->global_itexmo($user->contact_num, $text_message, "ST-CREAM343228_F3PNT", '8)tg(84@$$');
            }
            
            DB::table('orders')
                ->where('orders.invoice_id', $request->invoice_id)
                ->update(['order_cancel' => 1]);

                return response()->json(['response' => 'success'], 200);
        }
    }

    /**
     * @desc update quantity order
     */
    public function updateQuantityOrder(Request $request){
        if ($request->ajax()) {
            $order = Order::find($request->id);

            $product_price = $order->item_price; //$order->ordered_total_price / $order->quantity_ordered;

            // $order->quantity_ordered    = $request->quantity_ordered;
            // $order->ordered_total_price = $request->quantity_ordered * $product_price;
            if(Order::where('id',$request->id)->update([
                'quantity_ordered'      => $request->quantity_ordered,
                'ordered_total_price'   => $request->quantity_ordered * $product_price

            ]))
                return response()->json(['response' => 'success'], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pending = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                ->selectRaw("order_invoice.id, 
                order_invoice.created_at as date_ordered, 
                order_invoice.invoice_no, 
                SUM(orders.ordered_total_price) as total_price, 
                CONCAT(users.fname, ' ', users.lname) as fullname, 
                users.email, 
                orders.store_id,
                orders.delivery_date,
                users.id as client_id,
                users.contact_num as num")
                ->where('orders.is_approved', 0)
                ->where('orders.is_completed', 0)
                ->orderBy('id','desc')
                ->groupBy('orders.invoice_id')
                ->get()
                ->map(function($item){
                    $item->store_name = 'NA';
                    $item->assigned_staff = "NA";
                    if($store = DB::table('stores')->selectRaw('stores.area_id, stores.store_name, stores.store_address, areas.area_name')
                                ->join('areas', ['areas.id' => 'stores.area_id'])
                                    ->where('stores.id', $item->store_id)->first()){
                        $item->store_name = "Name: ". $store->store_name .'<br/>Area: '.$store->area_name. '<br/>Address: '.$store->store_address;
                        $item->assigned_staff = @User::where(['area_id' => $store->area_id, 'user_role' => 1])->first()->fname;
                    }
                    return $item;
                });

        if ($request->ajax()) {
            return Datatables::of($pending)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
   
                    $btn = '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->num.'" data-set="0" data-accept="pending" data-type="pending" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" id="editPendingOrder_'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm mt-1 editPendingOrder">Approve</a>';
                    $btn .= ' <a  href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger mt-1 btn-sm removeOrder">Decline</a>';
                    return $btn;
                })
                ->addColumn('total_price', function($row){
                    return '<strong>'.number_format($row->total_price,2).'</strong>';
                  })
                ->rawColumns(['action', 'total_price', 'store_name'])
                ->make(true);
        }

        return view('order.order', compact('pending'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client_id          = $request->input("pending_client_id");
        $date_to_display    = $request->input("pending_date_to_display");
        $delivery_date      = $request->input("delivery_date");
        $invoice_no         = $request->pending_invoice;
        
        if($user = User::find($client_id)){
            if($request->accept_type == "pending"){
                //set text message
                $text_message = "Hi, ". $user->fname . "\n \nYour order ".$invoice_no." has been approved.\nDelivery date is on ".$date_to_display.".\nThank you. Please see your account for more info
                \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

                //send it to customer
                $this->global_itexmo($user->contact_num, $text_message, "ST-CREAM343228_F3PNT", '8)tg(84@$$');
                $this->notificationDispatch([
                    'user_id'   => $user->id,
                    'type'      => 'order_approval',
                    'area_id'   => $user->area_id,
                    'email_to'  => 'client',
                    'message'   => "Your order ".$invoice_no." was approved. Delivery is scheduled on ".$date_to_display.".",
                    'status'    => 'unread'
                ]);  
            } else {
                $this->notificationDispatch([
                    'user_id'   => $user->id,
                    'type'      => 'order_approval',
                    'area_id'   => $user->area_id,
                    'email_to'  => 'client',
                    'message'   => "Your order ".$invoice_no." was rescheduled. The new delivery date is on ".$date_to_display.".",
                    'status'    => 'unread'
                ]);  
                //set text message
                $text_message = "Your order ".$invoice_no." was rescheduled. The new delivery date is on ".$date_to_display.".
                \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

                //send it to customer
                $this->global_itexmo($user->contact_num, $text_message, "ST-CREAM343228_F3PNT", '8)tg(84@$$');
            }
             


            new MailDispatch('order_approval', trim($user->email), array(
                'subject'       => $invoice_no. ' - Your Order has been Approved.',
                'title'         => $invoice_no. ' - Your Order has been Approved.',
                "site"          => '',
                "name"          => trim($user->fname),
                'invoice_no'    => $invoice_no,
                'delivery_date' => $date_to_display
            ));
        }

        foreach ($request->order as $key => $value) {
            Order::where('id', $value['order_id'])->update(['is_cancelled' => 0,'is_approved' => 1, 'delivery_date' => $delivery_date]);
        }
    
        $response = [
            'success'   => true,
            'message'   => 'Order successfully approved.'
        ];
        return response()->json($response, 200);

    }
}
