<?php

namespace App\Http\Controllers;

use App\ProductFileReport;
use App\{Product_Report, User};
use App\ReplacementProduct;
use App\Traits\GlobalFunction;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class OrderReplacementController extends Controller
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
        if(Auth::user()->user_role == 99) {
            // $file_replacement = Product_Report::all();
            // $file_replacement = Product_Report::orderBy('id', 'desc')
            // ->get()
            // ->map(function($item){
            //     $item->client_name  = 'NA';
            //     if($user = User::find($item->client_id)){
            //         $item->client_name  = $user->fname . ' '. $user->lname;
            //     }

            //     $item->issued_name  = 'NA';
            //     if($user = User::find($item->issued_by)){
            //         $item->issued_name  = $user->fname . ' '. $user->lname;
            //     }

            //     return $item;
            // });

            $file_replacement = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                // ->selectRaw("order_invoice.id, order_invoice.created_at as date_ordered, order_invoice.invoice_no, SUM(orders.ordered_total_price) as , CONCAT(users.fname, ' ', users.lname) as fullname, users.email")
                ->selectRaw("order_invoice.id, 
                order_invoice.created_at as date_ordered, 
                order_invoice.invoice_no, 
                SUM(orders.ordered_total_price) as total_price, 
                CONCAT(users.fname, ' ', users.lname) as fullname, 
                users.email, 
                orders.delivery_date,
                orders.attempt,
                users.id as client_id,
                users.contact_num as num")
                // ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered',
                //     'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
                ->where('is_cancelled', 1)
                ->where('order_cancel', 0)
                ->groupBy('orders.invoice_id')
                ->get();

            if ($request->ajax()) {
                return Datatables::of($file_replacement)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
    
                        $btn = '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->num.'" data-set="0" data-type="pending" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm viewDetails">View Details </a> ';
                        $btn .= '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->num.'" data-set="2" data-type="all" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-success btn-sm mt-1 editPendingOrder">Re-Schedule</a>';
                        // $btn .= '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->num.'" data-set="0" data-type="pending" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-success btn-sm editPendingOrder mt-1">Re-Schedule</a>';
                        $btn .= '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->num.'" data-set="0" data-type="pending" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-danger btn-sm cancelOrder mt-1">Cancel</a>';
                        return $btn;
                    })
                    ->addColumn('total_price', function($row){
                        return '<strong>'.number_format($row->total_price,2).'</strong>';
                    })
                    ->rawColumns(['action', 'total_price'])
                    ->make(true);
            }

        } else {
            $file_replacement = Product_Report::where('client_id', Auth::user()->id)
                                    ->get();            
        }
        if ($request->ajax()) {
            return Datatables::of($file_replacement)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->delivery_date != null) {
                        return "NA";
                    }
                    if ($row->is_replaced == 1) {
                        $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-clientid="'.$row->client_id.'" data-original-title="Edit" class="btn btn-success btn-sm setDeliver">Set Delivery</a>&nbsp;';
                    } else if($row->is_replaced == 0){
                        $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-clientid="'.$row->client_id.'" data-original-title="Edit" class="btn btn-primary btn-sm editReplacementOrder mt-2">Approve</a>&nbsp;';
                        $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" data-clientid="'.$row->client_id.'" data-original-title="Edit" class="btn btn-danger btn-sm editDisapproveReplacement mt-2">Disapprove</a>';
                    } else {
                        $btn = 'NA';
                    }
                    return $btn;
                })
                ->addColumn('client', function($row){
                    return $row->client;
                })
                ->addColumn('status', function($row){
                  return $row->is_replaced;
                })
                ->addColumn('products', function($row) {
                    return $row->products;
                })
                ->addColumn('quantity', function($row) {
                   $total = 0;
                   foreach ($row->products as $value) {
                     $total += $value->quantity;
                   }
                    return $total;
                })
                ->addColumn('images', function($row) {
                    return $row->images;
                })
                ->rawColumns(['status','products','quantity', 'images', 'action'])
                ->make(true);
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
        //store the action
        $action = $request->input("action");

        switch($action){
            //if approve replacement request button is clicked
            case "approve_replacement":
                Product_Report::where('id', $request->input("reportid"))
                                    ->update(["is_replaced" => 1]);
                
                //set message
                $message = 'Your Replacement request # '.$request->input("reportid").' has been accepted. Please be advised accordingly';

                //call the global function for setting the notification
                $this->set_notification("approved_customer_order", $message, $request->input("clientid"));

                return response()->json([
                    'message' => "Order Replacement Approved!",
                ]);
                break;
            case "disapprove_replacement":
                Product_Report::where('id', $request->input("reportid"))->update(["is_replaced" => 2]);
                
                //set message
                $message = 'Your Replacement request # '.$request->input("reportid").' has been disapproved. Please be advised accordingly';

                //call the global function for setting the notification
                $this->set_notification("approved_customer_order", $message, $request->input("clientid"));
                
                return response()->json([
                    'message' => "Order Replacement Disapproved!",
                ]);
                break;
            default:
                echo "do nothing here....";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_Report  $file_replacement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_report = Product_Report::find($id);
        $product_file_report = ProductFileReport::where('product_report_id', $id)->get();
        
        $data = [
          'product_report' => $product_report,
          'product_file_report' => $product_file_report
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_Report  $file_replacement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_Report $prod_report)
    {
        //do nothing...........
    }

    public function setDeliveryDate(Request $request)
    {
        $deliveryDate   = $request->txt_replacement_delivery_date;
        $fileReport     = Product_Report::find($request->id);
        $fileReport->delivery_date  = $deliveryDate;
        $fileReport->is_replaced    = 1;
        $fileReport->save();

        $clientReport = ProductFileReport::where('product_report_id', '=', $fileReport->id)->first();
        $clientReport->delivery_date = $deliveryDate;

        return response()->json([
            'message' => "Delivery Date Set!",
        ]);
    }

    public function updateProducts(Request $request)
    {
        $products = json_decode($request->props);

        foreach ($products as $product) {
            $prd = ReplacementProduct::find($product->id);
            $prd->quantity = $product->value;
            $prd->save();
        }

        return response()->json('Success');
    }
}
