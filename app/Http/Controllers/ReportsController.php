<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use App\{Order, User};
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

    public function getDetails(Request $request){
        if ($request->ajax()) {
        return Order::join('products', ['products.id' => 'orders.product_id'])
                            ->selectRaw('orders.*, products.name as product_name')
                                ->where('orders.invoice_id', $request->id)->get();
        }
    }

    public function getOrders(Request $request){
        if ($request->ajax()) {
            $start_date = date('Y-m-d 00:00:00', strtotime($request->date_from));
            $end_date = date('Y-m-d 23:59:59', strtotime($request->date_to));
        
            $response = DB::table('order_invoice')
            ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
            ->leftJoin('users', 'orders.client_id', '=', 'users.id')
            ->selectRaw("order_invoice.id,
            order_invoice.created_at as date_ordered,
            orders.delivery_date, 
                order_invoice.invoice_no, 
                SUM(orders.ordered_total_price) as total_price, CONCAT(users.fname, ' ', users.lname) as fullname, 
                orders.store_id
            ")
            ->where('order_invoice.created_at','>=', $start_date)
            ->where('order_invoice.created_at','<=',$end_date)
            ->when($request->filter_status == 'ALL', function($sql) use ($request){ 
                return $sql->orWhere('orders.is_approved', 0) //pending
                ->orwhere('orders.is_replacement', 1) //replacement
                ->orwhere('orders.is_damages', 1); //damages
            })
            ->when($request->filter_status != 'ALL', function($sql) use ($request){
                    switch ($request->filter_status) {
                        case 'PENDING':
                            return $sql->where('orders.is_approved', 0)
                                    ->where('orders.is_completed', 0)
                                    ->where('orders.is_damages', 0);
                        break;
                        case 'REPLACEMENT':
                            return $sql->where('orders.is_replacement', 1)
                                        ->where('orders.is_damages', 0);
                        break;
                        case 'DAMAGES':
                            return $sql->where('orders.is_completed', 0)
                                        ->where('orders.is_replacement', 1)
                                        ->where('orders.is_damages', 1);
                        break;

                    }
                })
            ->groupBy('orders.invoice_id')
            ->get()
            ->map(function($item){
                $item->total_price = number_format($item->total_price, 2);
                $item->assigned_staff = "NA";
                if($store = DB::table('stores')
                        ->selectRaw('stores.area_id, stores.store_name, stores.store_address, areas.area_name')
                            ->join('areas', ['areas.id' => 'stores.area_id'])
                                ->where('stores.id', $item->store_id)->first()){
                    $item->assigned_staff = User::where(['area_id' => $store->area_id, 'user_role' => 1])->first()->fname;
                }
                return $item;
            });
            return Datatables::of($response)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-success viewDetails">VIEW DETAILS</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } 



        // $start_date = date('Y-m-d 00:00:00', strtotime($request->date_from));
        // $end_date = date('Y-m-d 23:59:59', strtotime($request->date_to));
        
        // $response = DB::table('order_invoice')
        //         ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
        //         ->leftJoin('users', 'orders.client_id', '=', 'users.id')
        //         ->leftJoin('stores', 'stores.id', '=', 'orders.store_id')
        //         ->selectRaw("order_invoice.id, order_invoice.created_at as date_ordered,orders.delivery_date, 
        //             order_invoice.invoice_no, 
        //             SUM(orders.ordered_total_price) as total_price, CONCAT(users.fname, ' ', users.lname) as fullname, 
        //             users.email, 
        //             users.contact_num,
        //             stores.store_name
        //         ")
        //         ->where('order_invoice.created_at','>=', $start_date)
        //         ->where('order_invoice.created_at','<=',$end_date)
        //         ->when($request->filter_status != 'ALL', function($sql) use ($request){
        //             switch ($request->filter_status) {
        //                 case 'PENDING':
        //                     return $sql->where('orders.is_approved', 0)
        //                             ->where('orders.is_completed', 0)
        //                             ->where('orders.is_damages', 0);
        //                 break;
        //                 case 'FOR DELIVERY':
        //                     return $sql->where('orders.is_approved', 1)
        //                             ->where('orders.is_completed', 0)
        //                             ->where('orders.is_damages', 0);
        //                 break;
        //                 case 'UNDELIVERED':
        //                     return $sql->where('orders.is_cancelled', 1)
        //                             ->where('orders.order_cancel', 0)
        //                             ->where('orders.is_damages', 0);
        //                 break;
        //                 case 'REPLACEMENT':
        //                     return $sql->where('orders.is_completed', 1)
        //                                 ->where('orders.is_replacement', 1)
        //                                 ->where('orders.is_damages', 0);
        //                 break;
        //                 case 'DAMAGES':
        //                     return $sql->where('orders.is_completed', 0)
        //                                 ->where('orders.is_replacement', 1)
        //                                 ->where('orders.is_damages', 1);
        //                 break;
        //                 case 'CANCELLED':
        //                     return $sql->where('orders.order_cancel', 1);
        //                 break;
        //                 case 'COMPLETED':
        //                     return $sql->where('orders.is_completed', 1)
        //                                 ->where('orders.is_replacement', 0)
        //                                 ->where('orders.is_damages', 0);
        //                 break;
        //             }
        //         })
        //         ->groupBy('orders.invoice_id')
        //         ->get()
        //         ->map(function($item){
        //             $item->items = Order::join('products', ['products.id' => 'orders.product_id'])
        //                         ->selectRaw('orders.*, products.name as product_name')
        //                             ->where('orders.invoice_id', $item->id)->get();
        //             return $item;
        //         });

        // return response()->json($response, 200);        
    }
}
