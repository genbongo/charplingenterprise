<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
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
        $carts = Cart::findMany(Session::get('cart_data'));
        return view("client.transaction", compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get the request inputs
        $client_id      = $request->input("client_id");

        $id             = DB::table('order_invoice')->insertGetId(['invoice_no' => null, 'user_id' => $client_id, 'created_at' => date('Y-m-d H:i:s')]);
        $orderId        = 0;
        $count_order    = DB::table('order_invoice')->select('id')->whereRaw('DATE(created_at) = DATE("'.date('Y-m-d H:i:s').'")')->limit(1)->first();
        $orderId        = (int) ($id - $count_order->id) + 1;

        $uId            = sprintf("%04s", $orderId);
        $invoiceNo      = date('ymd').$uId;

        DB::table('order_invoice')->whereId($id)->update(['invoice_no' => $invoiceNo]);

        
        // $current_id = $request->input("current_id");
        $store_id = $request->input("store_id");
        $is_replacement = $request->input("is_replacement");

        //get the data from our session cart
        // $cart_data = session('cart_data');
        $cart_data = Cart::findMany(Session::get('cart_data'));

        foreach ($cart_data as $session_cart) {
            $cart               = Cart::find($session_cart->id);
            $cart->is_checkout  = '1';
            $cart->is_placed    = '1';
            $cart->save();
        }

        $cart_object_array = [];

        //loop the cart data
        foreach($cart_data as $cart){

            if(!empty($cart)){
                $now = Carbon::now();

                $cart_object_array[] = [
                    "client_id"             => $client_id,
                    'invoice_id'            => $id,
                    "delivery_date"         => Auth::user()->user_role == 99 ? $request->delivery_date : null,
                    "store_id"              => $store_id,
                    "product_id"            => $cart["product_id"],
                    "product_stock_id"      => $cart["product_stock_id"],
                    "size"                  => $cart["size"],
                    "flavor"                => $cart["flavor"],
                    "quantity_ordered"      => $cart["quantity"],
                    "ordered_total_price"   => $cart["subtotal"],
                    "item_price"            => $cart['price'],
                    "quantity_received"     => 0,
                    "received_total_price"  => 0,
                    "is_replacement"        => $is_replacement,
                    "is_approved"           => Auth::user()->user_role == 99,
                    "is_cancelled"          => 0,
                    "is_rescheduled"        => 0,
                    "is_completed"          => 0,
                    "attempt"               => 0,
                    "reason"                => "",
                    'updated_at'            => $now,
                    'created_at'            => $now
                ];
            }
        }

        if(Order::insert($cart_object_array)){

            //then delete also the session
            Session::forget("cart_data");

            // return response
            $response = [
                'success' => true,
                'message' => 'Order successfully saved.',
            ];
        }else{

            // return response
            $response = [
                'success' => false,
                'message' => 'There is an error in saving the order.',
            ];
        }
        return response()->json($response, 200);
    }

    /*
    *   Created a function that will redirect the user to information page after the successful order
    */

    public function thankyou()
    {
        return view("client.info");
    }
}
