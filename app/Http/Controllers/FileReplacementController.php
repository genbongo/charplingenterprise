<?php

namespace App\Http\Controllers;

use App\ProductFileReport;
use App\Product_Report;
use App\ReplacementProduct;
use App\{Store, User};
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class FileReplacementController extends Controller
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
        if(Auth::user()->user_role == 99) {
            $file_replacement = Product_Report::leftJoin('stores', ['stores.id' => 'product_reports.store_id'])
                                    ->selectRaw('product_reports.*, stores.store_name')
                                    ->when($request->type, function($sql) use($request){
                                        if($request->type == 'replacement'){
                                            return $sql->where('product_reports.report_type', 'Replacement');
                                        } else {
                                            return $sql->where('product_reports.report_type', 'Delivery Issues');
                                        }
                                    })
                                    ->orderBy('id', 'desc')
                                    ->get()
                                    ->map(function($item){
                                        $item->issued_by  = $item->issued_by; //'NA';
                                        if($user = User::find($item->issued_by)){
                                            $item->issued_by  = $user->fname . ' '. $user->lname;
                                        } else {
                                            $item->issued_by = 'NA';
                                        }

                                        $item->client_name  = 'NA';
                                        if($user1 = User::find($item->client_id)){
                                            $item->client_name  = $user1->fname . ' '. $user1->lname;
                                        }

                                        return $item;
                                    });
        } else {

            if(Auth::user()->user_role == 1){ //staff
                $file_replacement = Product_Report::leftJoin('stores', ['stores.id' => 'product_reports.store_id'])
                            ->selectRaw('product_reports.*, stores.store_name')
                            ->where(['issued_by' => Auth::user()->id])
                            ->get()
                            ->map(function($item){
                                $item->full_name  = 'NA';
                                if($user = User::find($item->client_id)){
                                    $item->full_name  = $user->fname . ' '. $user->lname;
                                }
                                return $item;
                            });
            } else { //client
                $file_replacement = Product_Report::join('stores', ['stores.id' => 'product_reports.store_id'])
                        ->selectRaw('product_reports.*, stores.store_name')
                        ->where(['client_id' => Auth::user()->id])
                        ->get()
                        ->map(function($item){
                            $item->full_name  = 'NA';
                            if($user = User::find($item->issued_by)){
                                $item->full_name  = $user->fname . ' '. $user->lname;
                            }
                            return $item;
                        });
            }
            
        }

        if ($request->ajax()) {
            if(Auth::user()->user_role == 99) {
                return Datatables::of($file_replacement)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                  return $row ? $row->is_replaced : '-';
                })
                ->addColumn('products', function($row) {
                    return $row ? $row->products : '';
                })
                ->editColumn('store_name', function($row){
                    return $row->store_name ? $row->store_name : 'NA';
                })
                ->addColumn('quantity', function($row) {
                   $total = 0;
                   foreach ($row->products as $value) {
                     $total += $value->quantity;
                   }
                    return $total;
                })
                ->addColumn('images', function($row) {
                    return $row ? $row->images : '';
                })
                ->addColumn('action', function ($row) {
                    // if(!$row->is_replaced){
                    //     $btn = '<a href="javascript:void(0)" data-val="'.$row->products.'" data-toggle="tooltip" data-placement="top" title="Replace Order" data-id="'.$row->id.'" data-clientid="'.$row->client_id.'" data-original-title="Edit" class="btn btn-primary btn-sm editDamageOrder">Approve</a>&nbsp;';
                    //     $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Disapprove Damage" data-id="'.$row->id.'" data-clientid="'.$row->client_id.'" data-original-title="Edit" class="btn btn-danger btn-sm editDisapproveDamage mt-1">Decline</a>';
                    // } else {
                    //     $btn = 'NA';
                    // }

                    //  return $btn;
                    return '';
                })
                ->rawColumns(['action','status', 'quantity', 'images'])
                ->make(true);
            } else {
                return Datatables::of($file_replacement)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                    return $row ? $row->is_replaced : '-';
                    })
                    ->editColumn('store_name', function($row){
                        return $row->store_name ? $row->store_name : 'NA';
                    })
                    ->addColumn('products', function($row) {
                        return $row ? $row->products : '';
                    })
                    ->addColumn('quantity', function($row) {
                    $total = 0;
                    foreach ($row->products as $value) {
                        $total += $value->quantity;
                    }
                        return $total;
                    })
                    ->addColumn('images', function($row) {
                        return $row ? $row->images : '';
                    })
                    ->rawColumns(['status', 'quantity', 'images'])
                    ->make(true);
            }
            
        }

        if(Auth::user()->user_role == 2 ) {
            $stores = Auth::user()->stores;
        } else {
            $stores = Store::all();
        }

        return view('file_replacement/index', compact('file_replacement', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prodIds    = $request->product;
        $size       = $request->size;
        $quantity   = $request->quantity;

        if($request->hasFile('file_report_image'))
        {
            $allowedfileExtension=['jpg','png', 'jpeg'];
            $files = $request->file('file_report_image');

            if(Auth::user()->user_role == 1){ //staff
                $items = Product_Report::create([
                    'report_type'       => $request->report_type,
                    'product_id'        => null,
                    'store_id'          => $request->store,
                    'size'              => null,
                    'flavor'            => null,
                    'client_id'         => $request->client_id,
                    'issued_by'         => Auth::user()->id,
                    'is_replaced'       => 0,
                    'reason'            => $request->reason,
                ]);
            } else {
                $items = Product_Report::create([
                    'report_type'       => $request->report_type,
                    'product_id'        => null,
                    'store_id'          => $request->store,
                    'size'              => null,
                    'flavor'            => null,
                    'client_id'         => Auth::user()->id,
                    'issued_by'         => null,
                    'is_replaced'       => 0,
                    'reason'            => $request->reason,
                ]);
            }
            

            foreach ($prodIds as $key => $product) {
                $data = explode('-',$size[$key]);
                ReplacementProduct::create([
                  'product_report_id'   => $items->id,
                  'product_id'          => $product,
                  'size'                => $data[0],
                  'price'               => $data[1],
                  'product_stock_id'    => $data[2],
                  'quantity'            => $quantity[$key]
                ]);
            }

            foreach($files as $file){
                // $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                $new_name = rand() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/filereport'), $new_name);

                if($check)
                {
                    ProductFileReport::create([
                        'product_report_id' => $items->id,
                        'file_report_image' => $new_name,
                        'quantity' => $request->quantity,
                    ]);
                }
            }

            // return response
            $response = [
                'success' => true,
                'message' => 'File replacement has been sent to the Admin! Please wait for the approval.',
            ];
            return response()->json($response, 200);
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
    public function destroy(Product_Report $file_replacement)
    {
        //do nothing......
    }
}
