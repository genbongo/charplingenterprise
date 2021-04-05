<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use Illuminate\Support\Facades\DB;
class ReportsController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('reports.report_orders');
    }

    public function getOrders(Request $request){
        $response = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->leftJoin('users', 'orders.client_id', '=', 'users.id')
                ->leftJoin('stores', 'stores.id', '=', 'orders.store_id')
                ->selectRaw("order_invoice.id, order_invoice.created_at as date_ordered,orders.delivery_date, 
                    order_invoice.invoice_no, 
                    SUM(orders.ordered_total_price) as total_price, CONCAT(users.fname, ' ', users.lname) as fullname, 
                    users.email, 
                    users.contact_num,
                    stores.store_name
                ")
                ->when($request->filter_status != 'ALL', function($sql) use ($request){
                    switch ($request->filter_status) {
                        case 'PENDING':
                            return $sql->where('orders.is_approved', 0)
                                    ->where('orders.is_completed', 0)
                                    ->where('orders.is_damages', 0);
                        break;
                        case 'FOR DELIVERY':
                            return $sql->where('orders.is_approved', 1)
                                    ->where('orders.is_completed', 0)
                                    ->where('orders.is_damages', 0);
                        break;
                        case 'UNDELIVERED':
                            return $sql->where('orders.is_cancelled', 1)
                                    ->where('orders.order_cancel', 0)
                                    ->where('orders.is_damages', 0);
                        break;
                        case 'REPLACEMENT':
                            return $sql->where('orders.is_completed', 1)
                                        ->where('orders.is_replacement', 1)
                                        ->where('orders.is_damages', 0);
                        break;
                        case 'DAMAGES':
                            return $sql->where('orders.is_completed', 0)
                                        ->where('orders.is_replacement', 1)
                                        ->where('orders.is_damages', 1);
                        break;
                        case 'COMPLETED':
                            return $sql->where('orders.is_completed', 1)
                                        ->where('orders.is_replacement', 0)
                                        ->where('orders.is_damages', 0);
                        break;
                    }
                })
                ->groupBy('orders.invoice_id')
                ->get()
                ->map(function($item){
                    $item->items = Order::join('products', ['products.id' => 'orders.product_id'])
                                ->selectRaw('orders.*, products.name as product_name')
                                    ->where('orders.invoice_id', $item->id)->get();
                    return $item;
                });

        return response()->json($response, 200);        
    }
}
