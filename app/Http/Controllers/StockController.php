<?php

namespace App\Http\Controllers;

use App\{Stock,ProductStock};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;
class StockController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->input();
        //insert to stock table
        $stockModel = Stock::updateOrCreate([
            'id' => $request->stock_id
        ],[
            'product_id' => $request->input("stock_product_id"),
            'quantity' => $request->input("stocks"),
            'threshold' => $request->input("threshold"),
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Stock successfully updated.',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::where('product_id', $id)->first();
        return response()->json($stock);
    }

    /***
     * NEw process of stocks
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUpdate(Request $request)
    {
        if ($request->ajax()) {
            ProductStock::updateOrCreate([
                'id' => $request->id
            ],[
                'product_id'     => $request->product_id,
                'size'           => $request->size,
                'quantity'       => $request->quantity,
                'price'          => $request->price,
                'threshold'      => $request->threshold,
                'promo'          => $request->promo,
                'status'         => $request->status,
            ]);

            return response()->json([
                'message'   => 'Stock Successfully submitted.',
                200
            ]);
        }
    }

    public function getStocksTable(Request $request){
        if ($request->ajax()) {
            $stocks = ProductStock::where('product_id', $request->product_id)
                ->when($request->filter_status != 'all', function($sql) use($request){
                if(in_array($request->filter_status, [0,1])){
                    return $sql->where('status', $request->filter_status);
                } else if($request->filter_status == 2){
                    return $sql->whereRaw('quantity <= threshold')->where('quantity','>', 0);
                } else if($request->filter_status == 3){
                    return $sql->where('quantity', 0);
                }
            })
            ->OrderBy('id', 'desc');
            return Datatables::of($stocks)
                ->addIndexColumn()
                ->addColumn('action', function ($row) { 
                    $btn = '<a href="javascript://;" data-toggle="tooltip" data-placement="top" title="Update Product" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStock">Edit</a>';
                    return $btn;
                })
                ->editColumn('status', function ($row) {
                    $status = '';
                    // if($row->status == 0){
                    //     $status = '<span class="text-success font-weight-bold">Available</span>';
                    // } 
                    // else if($row->status == 1){
                    //     $status = '<span class="text-danger font-weight-bold">Unavailable </span>';
                    // } 
                    // return $status;
                    if($row->status == 0 ){
                        $status = '<span class="text-success font-weight-bold">Available</span>';
                        if($row->quantity == 0){
                            $status = '<span class="text-danger font-weight-bold"">Out of Stock</span>';
                        } 
                        else if($row->quantity <= $row->threshold){
                            $status = '<span class="text-warning font-weight-bold">Running Low</span>';
                        }
                    } 
                    else if($row->status == 1){
                        $status = '<span class="text-danger font-weight-bold">Phased out</span>';
                    } 
                     
                    
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function getStocksRow(Request $request){
        if ($request->ajax()) {
            $stock = ProductStock::find($request->id);
            return response()->json($stock);
        }
    }
}
