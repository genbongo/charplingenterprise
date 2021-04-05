<?php

namespace App\Http\Controllers;

use App\{
    Cart,
    Product,
    Order,
    Product_Report
};
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
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
        $cart = Cart::latest()
                     ->where('user_id', Auth::user()->id)
                     ->where(function($query){
                        $query->where('is_checkout', '0')
                              ->orWhere('is_placed', '0');
                     })
                     ->get();

        if ($request->ajax()) {
            return Datatables::of($cart)
                ->addIndexColumn()
                ->addColumn('select', function(){
                    return false;
                })
                ->addColumn('action', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Remove Cart" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Remove" class="btn btn-danger btn-sm deleteCart">Remove</a>';

                    return $btn;
                })
                ->rawColumns(['select', 'action'])
                ->make(true);
        }

        return view('client/cart', compact('cart'));
    }

    public function storeDamageCart(Request $request){
        if ($request->ajax()) {
            $ids = array();
            $client_id      = $request->data_client_id;
            foreach ($request->damage as $key => $cart) {
                $product = Product::find($cart['product_id']);
                if($product){
                    $ids[] = Cart::insertGetId([
                        'product_id'            => $product->id,
                        'user_id'               => $client_id,
                        'product_name'          => $product->name,
                        'product_description'   => $product->description,
                        'product_image'         => $product->product_image,
                        'product_stock_id'      => $cart['product_stock_id'],
                        'size'                  => $cart['size'],
                        'flavor'                => '',
                        'quantity'              => $cart['quantity'],
                        'subtotal'              => ($cart['price'] * $cart['quantity']),
                        'is_checkout'           => '1',
                        'is_placed'             => '1',
                        'created_at'            => date('Y-m-d H:s:i'),
                        'updated_at'            => date('Y-m-d H:s:i')
                    ]);
                }
            }

            $id             = DB::table('order_invoice')->insertGetId(['invoice_no' => null, 'user_id' => $client_id, 'created_at' => date('Y-m-d H:i:s')]);
            $orderId        = 0;
            $count_order    = DB::table('order_invoice')->select('id')->whereRaw('DATE(created_at) = DATE("'.date('Y-m-d H:i:s').'")')->limit(1)->first();
            $orderId        = (int) ($id - $count_order->id) + 1;

            $uId            = sprintf("%04s", $orderId);
            $invoiceNo      = date('ymd').$uId;

            DB::table('order_invoice')->whereId($id)->update(['invoice_no' => $invoiceNo]);

            $store_id       = $request->input("data_store_id");

        $cart_data = Cart::whereIn('id', $ids)->get()->toArray();    
            //loop the cart data
        foreach($cart_data as $order){
            if(!empty($order)){
                $cart_object_array[] = [
                    "client_id"                 => $client_id,
                    'invoice_id'                => $id,
                    "delivery_date"             => $request->damage_delivery_date,
                    "store_id"                  => $store_id,
                    'product_stock_id'          => $order['product_stock_id'],
                    "product_id"                => $order["product_id"],
                    "size"                      => $order["size"],
                    "flavor"                    => $order["flavor"],
                    "quantity_ordered"          => $order["quantity"],
                    "ordered_total_price"       => $order["subtotal"],
                    "quantity_received"         => 0,
                    "received_total_price"      => 0,
                    "is_replacement"            => '1',
                    "is_approved"               => Auth::user()->user_role == 99,
                    "is_cancelled"              => 0,
                    "is_rescheduled"            => 0,
                    "is_completed"              => 0,
                    "is_damages"                => $request->report_type == 'damages' ? 1 : 0,
                    'is_replacement_reference'  => $request->product_report_id,
                    "attempt"                   => 0,
                    "reason"                    => "",
                    'updated_at'                => date('Y-m-d H:s:i'),
                    'created_at'                => date('Y-m-d H:s:i')
                ];
            }
        }

        if(Order::insert($cart_object_array)){
            Product_Report::where('id', $request->product_report_id)->update(['is_replaced' => '1']);
            $response = [
                'success' => true,
                'message' => '('.$invoiceNo . ') Order successfully saved.',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'There is an error in saving the order.',
            ];
        }
            return response()->json($response, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $cart = Cart::where('product_id', $request->product_id)
                        ->where('product_stock_id', $request->product_stock_id)
                        ->where('user_id', Auth::user()->id)
                        ->where('is_checkout', '0')
                        ->first();

        $quantity = $cart ? $cart->quantity + $request->quantity : $request->quantity;
        Cart::updateOrCreate([
            'user_id'           => Auth::user()->id,
            'product_id'        => $request->product_id,
            'product_stock_id'  => $request->product_stock_id,
            'is_checkout'       => '0',
        ],[
            'product_stock_id'      => $request->product_stock_id,
            'product_image'         => $product->product_image,
            'product_name'          => $request->product_name,
            'product_description'   => $request->product_description,
            'size'                  => $request->size,
            'flavor'                => $request->flavor,
            'quantity'              => $quantity,
            'price'                 => $request->price,
            'subtotal'              => ($quantity * $request->price)
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'Cart saved successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cart = Cart::find($id);
        return response()->json($cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        Cart::find($cart->id)->delete();
     
        return response()->json(['message'=>'Cart deleted successfully.']);
    }

    /**
     * Save the data to session from the cart
     */
    public function save_cart(Request $request)
    {
        $carts = Cart::find($request->ids);

        // foreach ($carts as $cart) {
        //     $cart->is_checkout = 1;
        //     $cart->save();
        // }

        // clear first the session named cart_data
        session()->forget('cart_data');

        // store the data into session named cart_data
        session(['cart_data' => $carts]);

        return response()->json(['message'=>'Sucessfully stored in session.']);
    }
}
