<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use DataTables;

class TransactionHistoryController extends Controller
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
        // $order = DB::table('orders')
        //         ->join('products', 'orders.product_id', '=', 'products.id')
        //         ->select('products.name', 'products.product_image', 'orders.quantity_ordered',
        //             'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'orders.cancelled_by')
        //         ->where('client_id', Auth::user()->id)
        //         ->get();
        $order = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                ->selectRaw("order_invoice.id, 
                order_invoice.created_at as date_ordered, 
                order_invoice.invoice_no, 
                SUM(orders.ordered_total_price) as total_price, 
                CONCAT(users.fname, ' ', users.lname) as fullname, 
                users.email, 
                orders.delivery_date,
                orders.is_approved,
                orders.is_completed,
                orders.is_cancelled,
                orders.delivery_date,
                users.id as client_id,
                users.lname,
                users.contact_num,
                orders.attempt,
                orders.reason")
                // ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered',
                //     'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
                // ->where('is_approved', 0)
                ->when($request->filter_status != 'all', function($sql) use($request){
                    if($request->filter_status == 'pending'){
                        return $sql->where('is_approved', 0);
                    } else {
                        return $sql->where('is_approved', 1);
                    }
                })
                ->where('users.id', Auth::user()->id)
                ->groupBy('orders.invoice_id')
                ->get();

        if ($request->ajax()) {
            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('total_price', function($row){
                    return '<strong>'.number_format($row->total_price,2).'</strong>';
                  })
                ->addColumn('action', function ($row) {
                    $btn = '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->contact_num.'" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm viewCompletedOrder">View details</a> ';
                    if($row->is_approved == 0){
                        $btn .= '<a  href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm viewCompletedOrder">Remove Order</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action','total_price'])
                ->make(true);
        }

        return view('client.transaction_history', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
}
