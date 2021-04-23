<?php

namespace App\Http\Controllers;

use App\{Order,User};
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
                    'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
                // ->where('orders.is_approved', $request->setId)
                ->where('orders.invoice_id', $request->invoice_id)
                ->get();
            } else {
                $pending = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered','orders.size',
                    'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
                ->where('orders.is_approved', $request->setId)
                ->where('orders.invoice_id', $request->invoice_id)
                ->get();
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

            $product_price = $order->ordered_total_price / $order->quantity_ordered;

            $order->quantity_ordered = $request->quantity_ordered;
            $order->ordered_total_price = $request->quantity_ordered * $product_price;
            if($order->save())
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
        // $pending = DB::table('orders')
        //         ->join('products', 'orders.product_id', '=', 'products.id')
        //         ->join('users', 'orders.client_id', '=', 'users.id')
        //         ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered',
        //             'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
        //         ->where('is_approved', 0)
        //         ->get();

        $pending = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                // ->selectRaw("order_invoice.id, order_invoice.created_at as date_ordered, order_invoice.invoice_no, SUM(orders.ordered_total_price) as , CONCAT(users.fname, ' ', users.lname) as fullname, users.email")
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
                // ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered',
                //     'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
                ->where('orders.is_approved', 0)
                ->where('orders.is_completed', 0)
                ->groupBy('orders.invoice_id')
                ->get()
                ->map(function($item){
                    $item->store_name = 'NA';
                    if($store = DB::table('stores')->where('id', $item->store_id)->first()){
                        $item->store_name = $store->store_name . ' ('.$store->store_address.')';
                    }
                    $item->assigned_staff = "NA";
                    if($client = User::find($item->client_id)){
                        $item->assigned_staff = User::where(['area_id' => $client->area_id, 'user_role' => 1])->first()->fname;
                    }
                    return $item;
                });

        if ($request->ajax()) {
            return Datatables::of($pending)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
   
                    $btn = '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->num.'" data-set="0" data-type="pending" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm editPendingOrder">Approve</a>';
                    $btn .= ' <a  href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm removeOrder">Remove Order</a>';
                    return $btn;
                })
                ->addColumn('total_price', function($row){
                    return '<strong>'.number_format($row->total_price,2).'</strong>';
                  })
                ->rawColumns(['action', 'total_price'])
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
            //set text message
            $text_message = "Hi, ". $user->fname . "\n \nYour order ".$invoice_no." has been approved.\nDelivery date is on ".$date_to_display.".\nThank you. Please see your account for more info
            \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

            //send it to customer
            $this->global_itexmo($user->contact_num, $text_message, "ST-CREAM343228_F3PNT", '8)tg(84@$$');

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
