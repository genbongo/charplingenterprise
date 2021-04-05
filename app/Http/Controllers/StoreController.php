<?php

namespace App\Http\Controllers;

use App\{Store,UserFridge, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class StoreController extends Controller
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
        $store = Store::join('areas', ['areas.id' => 'stores.area_id'])
                ->selectRaw('stores.*, areas.area_name')
                    ->where("user_id", Auth::user()->id)->latest()
                        ->get()->map(function($item){
                            $item->fullname = 'NA';
                            if($user = User::where(['area_id' => $item->area_id, 'user_role' => 1])->first()){
                                $item->fullname = $user->fname . ' ' .  $user->lname;
                            }
                            return $item;
                        });;

        if ($request->ajax()) {
            return Datatables::of($store)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    // $status = '';
                    // $delete_status = '';
                    // $delete_btn = '';

                    // if($row->is_deleted == 0){
                    //     $status = 0;
                    //     $delete_status = 'Delete';
                    //     $delete_btn = 'btn-danger';
                    // }else{
                    //     $status = 1;
                    //     $delete_status = 'Activate';
                    //     $delete_btn = 'btn-success';
                    // }
   
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStore">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="View" class="edit btn btn-success btn-sm viewFridge">Fridges</a>';

                    // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="'.$delete_status.' Store" data-stat="'.$status.'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn '.$delete_btn.' btn-sm deleteStore">'.$delete_status.'</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('store/store', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Store::updateOrCreate([
            'id' => $request->store_id
        ],[
            'store_name' => $request->store_name,
            'store_address' => $request->store_address,
            'area_id' => $request->area_id,
            'user_id' => $request->user_id,
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'Store saved successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        return response()->json($store);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $output = '';

        // $store->delete();
        if($store->is_deleted == 1){
            Store::where('id', $store->id)->update(["is_deleted" => 2]);
            $output = 'Successfully Deactivated!';
        }else{
            Store::where('id', $store->id)->update(["is_deleted" => 1]);
            $output = 'Successfully Activated!';
        }

        // return response
        $response = [
            'success', true,
            'message' => $output,
        ];
        return response()->json($response, 200);
    }

    public function getClientFridge(Request $request){
        $fridges = UserFridge::join('fridges', ['user_fridges.fridge_id' => 'fridges.id'])
                    ->selectRaw('fridges.id, fridges.model, fridges.description, fridges.status as stat')
                    ->where(['store_id' => $request->store_id])
                    ->get()
                    ->map(function($item){
                        if($item->stat == 1){
                            $item->status = '<span class="text-success font-weight-bold">Available</span>';
                        } 
                        else if($item->stat == 2){
                            $item->status = '<span class="text-danger font-weight-bold"">UnAvailable</span>';
                        }
                        else if($item->stat == 3){
                            $item->status = '<span class="text-warning font-weight-bold"">Pull Out</span>';
                        }
                        else if($item->stat == 4){
                            $item->status = '<span class="text-primary font-weight-bold"">Deployed</span>';
                        }
                        return $item;
                    });
        return response()->json( $fridges);                    
    }
}
