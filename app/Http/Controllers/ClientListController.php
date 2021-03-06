<?php

namespace App\Http\Controllers;

use App\User;
use App\{Store,AssignedArea};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use DataTables;

class ClientListController extends Controller
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

        // $area = auth()->user()->area;

        // $clients =  $area->clients();

        // $clients = User::where('area_id', auth()->user()->area_id)
        //                 ->where('user_role',2)->get();

        $area_asigned = AssignedArea::selectRaw('areas.id,areas.area_name')
                                ->join('areas', ['areas.id' => 'assigned_areas.area_id'])
                                ->where(['assigned_areas.user_id' => auth()->user()->id, 'assigned_areas.status' => 'active'])
                                    ->first();

        $clients  = User::selectRaw('users.*')->join('stores', ['stores.user_id' => 'users.id'])
                        ->where('stores.area_id', @$area_asigned->id)
                        ->where('users.user_role',2)->get();

        if ($request->ajax()) {
            return Datatables::of($clients)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="View Store" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm viewStore">View Stores</a> ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('staff/client_list', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->action == 'assign_client'){

            Store::updateOrCreate([
                'user_id' => $request->assign_id,
            ],[
                'user_id' => $request->assign_id,
                'area_id' => $request->area_id,
                'store_name' => "",
                'store_address' => "",
            ]);

            // return response
            $response = [
                'success' => true,
                'message' => 'Successfully Assigned.',
            ];
            return response()->json($response, 200);

        }else if($request->action == 'update_client_profile'){
            User::updateOrCreate([
                'id' => $request->client_id
            ],[
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'email' => $request->email,
                'contact_num' => $request->contact_num,
                'address' => "NA",
                'email_verified_at' => "2020-06-08 07:57:47",
                'img' => "NA",
                'remember_token' => "NA"
            ]);

            // return response
            $response = [
                'success' => true,
                'message' => 'Client successfully updated.',
            ];
            return response()->json($response, 200);
        }else{
            User::updateOrCreate([
                'id' => $request->client_id
            ],[
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'email' => $request->email,
                'contact_num' => $request->contact_num,
                'user_role' => 2,   //2 for client
                'is_pending' => 1,   //0 means not pending
                'password' => Hash::make($request->password),
                'address' => "NA",
                'email_verified_at' => "2020-06-08 07:57:47",
                'img' => "NA",
                'remember_token' => "NA"
            ]);

            // return response
            $response = [
                'success' => true,
                'message' => 'Client successfully saved.',
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = User::find($id);
        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $output = '';

        // $client->delete();
        if($client->is_active == 0){
            User::where('id', $client->id)->update(["is_active" => 1]);
            $output = 'Successfully Activated!';
        }else{
            User::where('id', $client->id)->update(["is_active" => 0]);
            $output = 'Successfully Deactivated!';
        }

        if($client->is_pending == 1){
            User::where('id', $client->id)->update(["is_pending" => 0, "is_active" => 1]);
            $output = 'Successfully Approved!';
        }

        // return response
        $response = [
            'success', true,
            'message' => $output,
        ];
        return response()->json($response, 200);
    }
}
