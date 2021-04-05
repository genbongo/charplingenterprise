<?php

namespace App\Http\Controllers;

use App\{Order,Stock, ProductStock, User};
use App\Traits\GlobalFunction;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Auth, Session};

class StaffDashboardController extends Controller
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

        $area = auth()->user()->area;

        $now = date('Y-m-d');

        // $order =  $area->orders()->where('delivery_date', '=', $now)->get();

        // if ($request->ajax()) {
            // return Datatables::of($order)
            //     ->addIndexColumn()
            //     ->addColumn('name', function($row) {
            //         return $row->client->fname. " " . $row->client->lname;
            //     })
            //     ->addColumn('store_name', function($row) {
            //         return $row->store->store_name;
            //     })
            //     ->addColumn('store_address', function($row) {
            //         return $row->store->store_address;
            //     })
            //     ->addColumn('action', function ($row) {

            //         if (!$row->is_completed && !$row->is_cancelled) {
            //             $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as completed" data-id="'.$row->id.'" class="btn btn-primary btn-sm editCompleteOrder">Completed</a>&nbsp;';

            //             $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as cancelled" data-id="'.$row->id.'" class="btn btn-danger btn-sm editCancelOrder">Cancel</a>';

            //              return $btn;
            //          } else {
            //             return 'NA';
            //          }
   
            //     })
            //     ->addColumn('status', function($row) {
            //         if ($row->is_completed) {
            //             return '<span class="text-success font-weight-bold">Completed</span>';
            //         }

            //         if ($row->is_cancelled) {
            //             return '<span class="text-danger font-weight-bold">Cancelled</span>';
            //         }

            //         if (!$row->is_completed) {
            //             return '<span class="text-info font-weight-bold">Pending</span>';
            //         }
            //     })
            //     ->rawColumns(['action', 'store_name', 'store_address', 'name', 'status'])
            //     ->make(true);
            
        // }

        $order = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('stores', 'orders.store_id', '=', 'stores.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                // ->selectRaw("order_invoice.id, order_invoice.created_at as date_ordered, order_invoice.invoice_no, SUM(orders.ordered_total_price) as , CONCAT(users.fname, ' ', users.lname) as fullname, users.email")
                ->selectRaw("order_invoice.id, 
                order_invoice.created_at as date_ordered, 
                order_invoice.invoice_no, 
                SUM(orders.ordered_total_price) as total_price, 
                CONCAT(users.fname, ' ', users.lname) as fullname, 
                users.email, 
                SUM(orders.attempt) as attempt, 
                orders.delivery_date,
                orders.is_completed,
                orders.is_cancelled,
                orders.is_replacement,
                users.id as client_id,
                users.contact_num as num")
                // ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered',
                //     'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
                // ->where('is_approved', 0)
                ->where('orders.delivery_date', '=', $now)
                ->where('stores.area_id', $area->id)
                ->groupBy('orders.invoice_id')
                ->get();

        if ($request->ajax()) {
            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('status', function($row) {
                    if ($row->is_completed) {
                        return '<span class="text-success font-weight-bold">Completed</span>';
                    }

                    if ($row->is_cancelled) {
                        return '<span class="text-danger font-weight-bold">Cancelled</span>';
                    }

                    if (!$row->is_completed) {
                        return '<span class="text-info font-weight-bold">For Delivery</span>';
                    }
                })
                ->addColumn('action', function ($row) use($area) {
   
                    // $btn = '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->num.'" data-set="0" data-type="pending" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm editPendingOrder">Approve</a>';
                    // return $btn;
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as completed" data-id="'.$row->id.'" data-type="1" class="btn btn-primary btn-sm mt-2 viewCompleteOrder">View Details</a> ';
                    if (!$row->is_completed && !$row->is_cancelled) {
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as completed" data-id="'.$row->id.'" data-type="0" class="btn btn-primary mt-2 btn-sm editCompleteOrder">Confirm</a> ';

                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as cancelled" data-id="'.$row->id.'" class="btn btn-danger btn-sm editCancelOrder mt-2">Cancel</a>';

                    } 
                    // else {
                    //     $btn .= 'NA';
                    // }
                    return $btn;
                })
                ->addColumn('total_price', function($row){
                    return '<strong>'.number_format($row->total_price,2).'</strong>';
                  })
                ->rawColumns(['action', 'total_price', 'status'])
                ->make(true);
        }

        return view('staff.dashboard', compact('order'));
    }

    public function pendingOrder(Request $request){
        if ($request->ajax()) {
            $pending = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered','orders.size',
                    'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
                ->where('orders.invoice_id', $request->invoice_id)
                ->get();

            return response()->json($pending, 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staffTransactions(Request $request)
    {

        // $area = auth()->user()->area;

        // $now = date('Y-m-d');

        // $order =  $area->orders()->get();

        // if ($request->ajax()) {
        //     return Datatables::of($order)
        //         ->addIndexColumn()
        //         ->addColumn('name', function($row) {
        //             return $row->client ? $row->client->fname. " " . $row->client->lname : '-';
        //         })
        //         ->addColumn('store_name', function($row) {
        //             return $row->store ? $row->store->store_name : '-';
        //         })
        //         ->addColumn('store_address', function($row) {
        //             return $row->store ? $row->store->store_address : '-';
        //         })
        //         ->addColumn('action', function ($row) {

        //             if (!$row->is_completed && !$row->is_cancelled) {
        //                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as completed" data-id="'.$row->id.'" class="btn btn-primary btn-sm editCompleteOrder">Completed</a>&nbsp;';

        //                 $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as cancelled" data-id="'.$row->id.'" class="btn btn-danger btn-sm editCancelOrder">Cancel</a>';

        //                  return $btn;
        //              } else {
        //                 return 'NA';
        //              }
   
        //         })
        //         ->addColumn('status', function($row) {
        //             if ($row->is_completed) {
        //                 return '<span class="text-success font-weight-bold">Completed</span>';
        //             }

        //             if ($row->is_cancelled) {
        //                 return '<span class="text-danger font-weight-bold">Cancelled</span>';
        //             }

        //             if (!$row->is_completed) {
        //                 return '<span class="text-info font-weight-bold">Pending</span>';
        //             }
        //         })
        //         ->rawColumns(['action', 'store_name', 'store_address', 'name', 'status'])
        //         ->make(true);
        // }

        $area = auth()->user()->area;

        $now = date('Y-m-d');

        // $order =  $area->orders()->where('delivery_date', '=', $now)->get();

        // if ($request->ajax()) {
            // return Datatables::of($order)
            //     ->addIndexColumn()
            //     ->addColumn('name', function($row) {
            //         return $row->client->fname. " " . $row->client->lname;
            //     })
            //     ->addColumn('store_name', function($row) {
            //         return $row->store->store_name;
            //     })
            //     ->addColumn('store_address', function($row) {
            //         return $row->store->store_address;
            //     })
            //     ->addColumn('action', function ($row) {

            //         if (!$row->is_completed && !$row->is_cancelled) {
            //             $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as completed" data-id="'.$row->id.'" class="btn btn-primary btn-sm editCompleteOrder">Completed</a>&nbsp;';

            //             $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as cancelled" data-id="'.$row->id.'" class="btn btn-danger btn-sm editCancelOrder">Cancel</a>';

            //              return $btn;
            //          } else {
            //             return 'NA';
            //          }
   
            //     })
            //     ->addColumn('status', function($row) {
            //         if ($row->is_completed) {
            //             return '<span class="text-success font-weight-bold">Completed</span>';
            //         }

            //         if ($row->is_cancelled) {
            //             return '<span class="text-danger font-weight-bold">Cancelled</span>';
            //         }

            //         if (!$row->is_completed) {
            //             return '<span class="text-info font-weight-bold">Pending</span>';
            //         }
            //     })
            //     ->rawColumns(['action', 'store_name', 'store_address', 'name', 'status'])
            //     ->make(true);
            
        // }

        $order = DB::table('order_invoice')
                ->join('orders', 'orders.invoice_id', '=', 'order_invoice.id')
                ->join('stores', 'orders.store_id', '=', 'stores.id')
                ->join('users', 'orders.client_id', '=', 'users.id')
                // ->selectRaw("order_invoice.id, order_invoice.created_at as date_ordered, order_invoice.invoice_no, SUM(orders.ordered_total_price) as , CONCAT(users.fname, ' ', users.lname) as fullname, users.email")
                ->selectRaw("order_invoice.id, 
                order_invoice.created_at as date_ordered, 
                order_invoice.invoice_no, 
                SUM(orders.ordered_total_price) as total_price, 
                CONCAT(users.fname, ' ', users.lname) as fullname, 
                users.email, 
                SUM(orders.attempt) as attempt, 
                orders.delivery_date,
                orders.is_completed,
                orders.is_cancelled,
                users.id as client_id,
                users.contact_num as num")
                // ->select('products.id AS prodID', 'products.name', 'products.product_image', 'orders.quantity_ordered',
                //     'orders.ordered_total_price', 'orders.created_at', 'orders.is_approved', 'orders.is_completed', 'orders.delivery_date', 'orders.id', 'users.fname', 'users.lname', 'users.contact_num', 'orders.client_id')
                // ->where('is_approved', 0)
                // ->where('orders.delivery_date', '=', $now)
                ->where('stores.area_id', $area->id)
                ->when($request->filter_status, function($sql) use($request){
                    if($request->filter_status == 'completed'){
                        return $sql->where('orders.is_completed', 1);
                    } else if($request->filter_status == 'cancelled'){
                        return $sql->where('orders.is_cancelled', 1);
                    } else {
                        return $sql->where(['orders.is_approved' => 1, 'orders.is_cancelled' => 0, 'orders.is_completed' => 0]);
                    }
                })
                ->groupBy('orders.invoice_id')
                ->get();

        if ($request->ajax()) {
            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('status', function($row) {
                    if ($row->is_completed) {
                        return '<span class="text-success font-weight-bold">Completed</span>';
                    }

                    if ($row->is_cancelled) {
                        return '<span class="text-danger font-weight-bold">Cancelled</span>';
                    }

                    if (!$row->is_completed) {
                        return '<span class="text-info font-weight-bold">Pending</span>';
                    }
                })
                ->addColumn('action', function ($row) use($area) {
   
                    // $btn = '<a data-invoice="'.$row->invoice_no.'" data-num="'.$row->num.'" data-set="0" data-type="pending" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Order" data-contact data-client="'.$row->client_id.'" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-sm editPendingOrder">Approve</a>';
                    // return $btn;

                    $btn = '<a href="javascript:void(0)" ata-type="1" data-toggle="tooltip" data-placement="top" title="Mark this order as completed" data-id="'.$row->id.'" class="btn btn-primary btn-sm viewCompleteOrder">View Details</a> ';
                    // if (!$row->is_completed && !$row->is_cancelled) {

                    //     $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Mark this order as cancelled" data-id="'.$row->id.'" class="btn btn-danger btn-sm editCancelOrder mt-2">Cancel</a>';

                    //      return $btn;
                    //  } else {
                    //     return 'NA';
                    //  }
                    return $btn;
                })
                ->addColumn('total_price', function($row){
                    return '<strong>'.number_format($row->total_price,2).'</strong>';
                  })
                ->rawColumns(['action', 'total_price', 'status'])
                ->make(true);
        }

        return view('staff.client_transaction_staff', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if completed
        if($request->input("action") == "completed"){

            //update the order
            DB::table('orders')->where('invoice_id', $request->input("invoice_id"))->update(['is_completed' => 1]);
            $order = DB::table('orders')->where('invoice_id', $request->input("invoice_id"))->get();
            foreach ($order as $key => $value) {
                $value->attempt +=  1;
                DB::table('orders')->where('id', $value->id)
                        ->update([
                            'attempt' => $value->attempt
                            ]);

                if($stock = ProductStock::where('id', $value->product_stock_id)->first()){
                    $quantity = $stock->quantity - $value->quantity_ordered;
                    ProductStock::where('id', $value->product_stock_id)->update([ 'quantity' => $quantity]);
                }
            }

            // return response
            $response = [
                'success' => true,
                'message' => 'Order Successfully Completed.',
            ];
            return response()->json($response, 200);
        }

        //if not completed
        if($request->input("action") == "cancel"){
            $staff          = auth()->user();
            $order          = DB::table('order_invoice')->whereId($request->order_id)->first();
            $client         = User::find($order->user_id);
            $cancel_option  = ($request->cancel_option == 1 ? 'Client Cancel' : 'Delivery Cancel');
            //admin reminder
            $this->notificationDispatch([
                'user_id'   => $staff->id,
                'type'      => 'staff_cancel_order',
                'area_id'   => $staff->area_id,
                'email_to'  => 'admin',
                'message'   => $staff->fname. " " . $staff->lname. " cancelled order " .$order->invoice_no. " of ".$client->fname. " " . $client->lname. " due to ".$cancel_option." (".$request->reason.").",
                'status'    => 'unread'
            ]);  
            
            // if 1 cancelled by client, if 2 cancelled by staff
            $cancelled_by = $request->input("cancel_option");

            // if ($cancelled_by == 2) {

            //     $text_message = 'We\'re sorry for the inconvenience. Your Order # '.$request->input("order_id").'cannot be delivered today to some technical difficulties';
            //     $this->messageNotification(null , $request->input("order_id"), $text_message);
            // }

            //update the order
            $attempt = DB::table('orders')->where('invoice_id', $request->input("order_id"))->get();
            foreach ($attempt as $key => $value) {
                $value->attempt +=  1;
                DB::table('orders')->where('id', $value->id)
                               ->update([
                                    'attempt' => $value->attempt,
                                    'cancelled_by' => $cancelled_by,
                                    'is_cancelled' => 1,
                                    'reason' => $request->input("reason")
                                   ]);
            }
            // DB::table('orders')->where('invoice_id', $request->input("order_id"))
            //                    ->update([
            //                         'cancelled_by' => $cancelled_by,
            //                         'is_cancelled' => 1,
            //                         'reason' => $request->input("reason")
            //                     ]);

            // return response
            $response = [
                'success' => true,
                'message' => 'Order Successfully Cancelled.',
            ];
            return response()->json($response, 200);
        }
    }

    public function emergency(Request $request)
    {
        $staff = Auth::user();
        $stores = $staff->area->stores;

        foreach ($stores as $store) {
            $now = date('Y-m-d');
            $order = Order::where('store_id', '=', $store->id)
                          ->where('delivery_date', '=', $now)
                          ->where('is_completed', '=', '0')
                          ->where('is_cancelled', '=', '0')
                          ->first();
            if($order) {
               $order->update([
                    'cancelled_by' => '2',
                    'is_cancelled' => '1',
                    'reason' => $request->input("reason")
                ]); 

                $text_message = 'We\'re sorry for the inconvenience. Your Order # '.$order->id.'cannot be delivered today to some technical difficulties';

                $this->messageNotification(null , $request->input("order_id"), $text_message);
            }
        }

        $text_message = 'Delivery from area'.$staff->area->area_name .'cannot be delivered today to some technical difficulties. 
                         Reason: '.
                         $request->reason;

        $this->messageNotification('09123213123' , $request->input("order_id"), $text_message);

        $response = [
            'success' => true,
            'message' => 'Emergency Message Sent!',
        ];
        return response()->json($response, 200);
    }

    public function messageNotification($contact_num = null, $order_id, $text_message)
    {
        // $result = $this->global_itexmo($contact_num, $text_message." \n\n\n\n","ST-CREAM343228_LGZPB", "#5pcg2mpi]");
        $result = $this->global_itexmo($contact_num, $text_message." \n\n\n\n","ST-CREAM343228_LGZPB", '#5pcg2mpi]');

        if ($result == ""){
            // echo "iTexMo: No response from server!!!
            // Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.   
            // Please CONTACT US for help. ";   
        }else if ($result == 0){
            // echo "Message Sent!";
        }
        else{    
            // echo "Error Num ". $result . " was encountered!";
        }

        return;
    }
}
