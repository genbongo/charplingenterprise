<?php

namespace App\Http\Controllers;

use App\{User, Store,UserFridge};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Helpers\Mail\SenderHelper as MailDispatch;
use App\Traits\GlobalFunction;

class ClientController extends Controller
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
        

        if($request->filter_status != 'all'){
            if($request->filter_status == 1){
                $where = ['is_active' => $request->filter_status, 'is_pending' => 0];
            } else if($request->filter_status == 0){
                $where = ['is_active' => $request->filter_status, 'is_pending' => 0];
            } else {
                $where = ['is_active' => 0, 'is_pending' => 1];
            }
            $client = User::latest()->where($where)->where('user_role', "2")->get();
        } else {
            $client = User::latest()->where('user_role', "2")->get();
        }

        // echo "<pre>";
        // var_dump($client);
        // echo "</pre>";

        if ($request->ajax()) {
            return Datatables::of($client)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $status = '';
                    $delete_status = '';
                    $delete_btn = '';

                    if($row->is_active == 0){
                        $status = 1;
                        $delete_status = 'Activate';
                        $delete_btn = 'btn-success';
                    }else{
                        $status = 0;
                        $delete_status = 'Deactivate';
                        $delete_btn = 'btn-danger';
                    }

                    // if($row->is_pending == 1){
                    //     $status = 2;
                    //     $delete_status = 'Pending';
                    //     $delete_btn = 'btn-outline-info';
                    // }
   
                    $btn = '<a href="javascript:void(0)"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editClient">Edit</a>';

                    if($row->is_pending == 0){
                        $btn .= ' <a href="javascript:void(0)" data-stat="'.$status.'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn '.$delete_btn.' btn-sm deleteClient" id="setup_client_'.$row->id.'">'.$delete_status.'</a>';
                        $btn .=' <a href="/client/'.$row->id.'/stores" class="btn btn-warning btn-sm">'.'Store'.'</a>';
                        // $btn .=' <a href="javascript:void(0)"  class="btn btn-info btn-sm">Profile</a>';
                    }
                    if($row->is_pending == 1){
                        $btn .= '<div class="dropdown">
                            <button class="dropbtn" id="status_update_'.$row->id.'">Status</button>
                            <div class="dropdown-content">
                                <a href="javascript://;" data-id="'.$row->id.'" class="status_update" data-status="accept">Accept</a>
                                <a href="javascript://;" data-id="'.$row->id.'" class="status_update" data-status="decline">Decline</a>
                            </div>
                        </div>';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('client/client', compact('client'));
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
            
            $user = User::updateOrCreate([
                'id' => $request->client_id
            ],[
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'email' => $request->email,
                'contact_num' => $request->contact_num,
                'user_role' => 2,   //2 for client
                'is_pending' => 0,   //0 means not pending
                'is_active'  => 1,   //1 means not active
                'password' => Hash::make($request->password),
                'address' => "NA",
                'email_verified_at' => "2020-06-08 07:57:47",
                'img' => "NA",
                'remember_token' => "NA"
            ]);

            if(!$request->client_id){

                new MailDispatch('client_approval', trim($request->email), array(
                    'subject'   => 'Welcome to Charpling Square Enterprise',
                    'title'     => 'Welcome to Charpling Square Enterprise', 
                    "status"    => 'admin_approve',
                    "name"      => trim($request->fname),
                    "password"  => $request->password
                ));
                
                $text_message = 'Hi, '. $request->fname . `
                    \n\nWelcome to Creamline! We are glad
                    to inform you that you are now one of
                    our retailers. \n Please click this link for
                    account confirmation and to change
                    your password: 
                    ` . $request->password . `Best regards,\n
                    Charpling Square Enterprise\n
                    Creamline Authorized Distributor`;
                
                //send it to customer
                $this->global_itexmo($request->contact_num, $text_message." \n\n\n\n","ST-CREAM343228_LGZPB", '#5pcg2mpi]');
            }

            // return response
            $response = [
                'success' => true,
                'message' => 'Client successfully saved.',
                $user
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function createClientStore(Request  $request){
        Store::updateOrCreate([
            'id' => $request->id
        ],[
            'store_name'        => $request->store_name,
            'store_address'     => $request->store_address,
            'area_id'           => $request->area_id,
            'user_id'           => $request->user_id,
            'is_deleted'        => 0
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'Client Store successfully submitted.',
        ];
        return response()->json($response, 200);
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
        $user = User::find($client->id);
        // $client->delete();
        if($client->is_active == 0){
            $user->update(["is_active" => 1]);
            $output = 'Successfully Activated!';
        }else{
            //staff reminder    
            $this->notificationDispatch([
                'user_id'   => $user->id,
                'type'      => 'client_deactivation',
                'area_id'   => $user->area_id,
                'email_to'  => 'staff',
                'message'   => "(" . $user->id . ") " . $user->fname. " ". $user->lname . "  is deactivated from the client’s list. ",
                'status'    => 'unread'
            ]);   

            //admin reminder
            $this->notificationDispatch([
                'user_id'   => $user->id,
                'type'      => 'reminder_admin_client_deactivate',
                'area_id'   => $user->area_id,
                'email_to'  => 'admin',
                'message'   => "(" . $user->id . ") " . $user->fname. " ". $user->lname . "  did not order within the 7-day allowance. He is now added to inactive list.                ",
                'status'    => 'unread'
            ]);  

            //set text message
            $text_message = "Hi, ". $user->fname . "\n \nWe are sorry to inform you that you are now deactivated from our retailer’s list. You can no longer login to our website. If you wish to continue our business, please contact your sales agent or the administration to activate your account again.             
            \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

            //send it to customer
            $this->global_itexmo($user->contact_num, $text_message, "ST-CREAM343228_F3PNT", '8)tg(84@$$');

            new MailDispatch('client_deactivation', trim($user->email), array(
                'subject'   => 'Account Deactivated',
                'title'     => 'Account Deactivated', 
                "site"      => '',
                "name"      => trim($user->fname)
            ));

            $user->update(["is_active" => 0]);
            $output = 'Successfully Deactivated!';
        }

        // if($client->is_pending == 1){
        //     //set text message
        //     $text_message = `Thank you for registering Creamline Products. You're account has been approved and you can now login to our official website. Enjoy!`;

        //     //send it to customer
        //     $this->global_itexmo($client->contact_num, $text_message." \n\n\n\n","ST-CREAM343228_LGZPB", '#5pcg2mpi]');
            
        //     User::where('id', $client->id)->update(["is_pending" => 0, "is_active" => 1]);
        //     $output = 'Successfully Approved!';
        // }

        // return response
        $response = [
            'success', true,
            'message' => $output,
        ];
        return response()->json($response, 200);
    }


    /**
     * Update Status Accept/ Decline
     *
     * @param  \App\User  $client
     * @return \Illuminate\Http\Response
     */
    public function acceptDeclineUserStatus(Request $request)
    {
        $output = '';
        $user = User::find($request->client_id);     
        $contact_number = $user->contact_num; 
        new MailDispatch('client_approval', trim($user->email), array(
            'subject'   => 'Creamline Registration Update',
            'title'     => 'Creamline Registration Update', 
            "status"    => $request->status,
            "name"      => trim($user->fname)
        ));
        
        if($request->status == 'accept'){
            User::where('id', $user->id)->update(["is_pending" => 0, "is_active" => 1]);

            $text_message = "Hi, ". $user->fname ."\nWelcome to Creamline! We are glad to inform you that you are now one of our retailers.
                \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

            //notification setup
            //staff
            $this->notificationDispatch([
                'user_id'   => $user->id,
                'type'      => 'approved_client',
                'area_id'   => $user->area_id,
                'email_to'  => 'staff',
                'message'   => '('.$user->id . ') '. $user->fname . ' '. $user->lname . ' is now added to your client’s list.<br> Click <a href="/client_list">here</a> for details.',
                'status'    => 'unread'
            ]);   
            //client 
            $this->notificationDispatch([
                'user_id'   => $user->id,
                'type'      => 'approved_client',
                'area_id'   => $user->area_id,
                'email_to'  => 'client',
                'message'   => 'Hi,'  . $user->fname . ' '. $user->lname . '. Welcome to creamline. <br>You can now order <a href="/shop">here</a>.',
                'status'    => 'unread'
            ]);   

            $output = 'Successfully Accepted!';
        } else {
            $text_message = "Hi, ". $user->fname . "\n\nWe are sorry to inform you that you did not passed the qualification as our retailer based on the documents you submitted.Please contact your sales agent or the administration for more details.You can still register in our website once you finalized the requirements we needed.
                \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

            $output = 'Successfully Declined!';            
        }

        $this->global_itexmo($contact_number, $text_message, "ST-CREAM343228_F3PNT", '8)tg(84@$$');
        
        if($request->status != 'accept')
            User::where('id', $user->id)->delete();
        
        return response()->json([
            'success', true,
            'message' => $output,
            'user'  => $user,
            $text_message
        ], 200);
    }


    /**
     * Update Status Accept/ Decline
     *
     * @param  \App\User  $client
     * @return \Illuminate\Http\Response
     */
    public function acceptDeclineUserStoreStatus(Request $request)
    {
        $output     = '';
        $user   = User::find($request->client_id);
        $store  = Store::find($request->store_id);    

        new MailDispatch('store_approval', trim($user->email), array(
            'subject'       => 'Creamline Store Update',
            'title'         => 'Creamline Store Update', 
            "status"        => $request->status,
            "name"          => trim($user->fname),
            "store_name"    => $store->store_name,
            "store_address" => $store->store_address
        ));
        
        if($request->status == 'accept'){
            $text_message = "Hi, ". $user->fname .
                "\n\nYour new store named " .$store->store_name. " located in " .$store->store_address. " has been approved. Please visit your account for more info.
                \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";
            $output = 'Successfully Accepted!';

            //client approved store
            $this->notificationDispatch([
            'user_id'   => $user->id,
            'type'      => 'approved_client_store',
            'area_id'   => $user->area_id,
            'email_to'  => 'client',
            'message'   => 'Your new store named '.$store->store_name.' located in '.$store->store_address.' has been approved.<br> Click <a href="/store">here</a> to see assigned sales agent.',
            'status'    => 'unread'
            ]);   

        } else {
            $text_message = "Hi, ". $user->fname .
            "\n\nYour new store named " .$store->store_name. " located in has been declined. Please contact us or your sales agent to discuss the problem.Please visit your account for more info.
            \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

            $output = 'Successfully Declined!';    
            
            //client disapproved store
            $this->notificationDispatch([
                'user_id'   => $user->id,
                'type'      => 'disapproved_client_store',
                'area_id'   => $user->area_id,
                'email_to'  => 'client',
                'message'   => 'Your new store named '.$store->store_name.' located in '.$store->store_address.' has been declined.<br> Click <a href="/store">here</a> to see assigned sales agent. <br>Please contact us or your sales agent to discuss the problem.',
                'status'    => 'unread'
                ]);   
        }

        //send it to customer
        $this->global_itexmo($user->contact_num, $text_message, "ST-CREAM343228_F3PNT", '8)tg(84@$$');

        
        if($request->status != 'accept'){
            Store::where('id', $request->store_id)->delete();
        } else {
            Store::where('id', $request->store_id)->update(['is_deleted' => 1]);
        }
        
        return response()->json([
            'success', true,
            'message' => $output
        ], 200);
    }

    public function storeList($id, Request $request)
    {
        $client = User::find($id);


       if ($request->ajax()) {
            // $stores = $client->stores;

            if($request->filter_status != 'all'){
                $where = ['stores.user_id' => $id, 'is_deleted' => $request->filter_status];
            } else {
                // $client = User::latest()->where('user_role', "2")->get();
                $where = ['stores.user_id' => $id];
            }

            $stores = Store::selectRaw("stores.*")
                                ->where($where)
                                    ->get()->map(function($item){
                                        $item->fullname = 'NA';
                                        if($user = User::where(['area_id' => $item->area_id, 'user_role' => 1])->first()){
                                            $item->fullname = $user->fname . ' ' .  $user->lname;
                                        }
                                        return $item;
                                    });

            return Datatables::of($stores)
                ->addIndexColumn()
                ->addColumn('area', function($row) {
                    return $row->area->area_name;
                })
                ->addColumn('action', function ($row) {
                    $status = '';
                    $delete_status = '';
                    $delete_btn = '';
                    $btn_label = '';
                    $title = '';

                    if($row->is_deleted == 1){
                        $status = 0;
                        $delete_status = 'Active';
                        $delete_btn = 'btn-danger';
                        $btn_label = 'Deactivate';
                        $btn_type = "deactivate";
                        $title = "Deactivate Store";
                    }else{
                        $status = 0;
                        $delete_status = 'Deactivate';
                        $delete_btn = 'btn-success';
                        $btn_label = 'Activate';
                        $btn_type = "activate";
                        $title = "Activate Store";
                    }

                    
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Edit Store" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStore">Edit</a> ';
                    if($row->is_deleted == 0){
                        $btn .= '<div class="dropdown">
                            <button class="dropbtn" id="status_update_'.$row->id.'">Status</button>
                            <div class="dropdown-content">
                                <a href="javascript://;" data-store_id="'.$row->id.'" data-id="'.$row->user_id.'" class="status_update" data-status="accept">Accept</a>
                                <a href="javascript://;" data-store_id="'.$row->id.'" data-id="'.$row->user_id.'" class="status_update" data-status="decline">Decline</a>
                            </div>
                        </div>';
                    } else {
                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="'.$title.'" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn '.$delete_btn.' btn-sm '.$btn_type.'">'. $btn_label .'</a>';
                    }
                    // $store = User::where(['area_id' => $row->area_id])->first();
                    // $btn .=' <button type="button" data-toggle="tooltip" data-placement="top" '.(!$store ? 'disabled' : '').' title="Assigned Staff" data-toggle="tooltip" data-area="'.$row->area_id.'" data-id="'.($store ? $store->user_id : 0).'" data-original-title="Assigned Store" class="btn btn-success btn-sm viewStore">Assigned Staff</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view("client/store_list", compact('client'));
    }


    public function storeListJson($id)
    {
        // $client = User::find($id);

        // return response()->json( $client->stores);

        $stores = Store::selectRaw('stores.*')
                    // ->leftJoin('user_fridges', ['user_fridges.store_id' => 'stores.id'])
                    // ->leftJoin('fridges', ['user_fridges.fridge_id' => 'fridges.id'])
                    ->where(['user_id' => $id])->get()
                    ->map(function($item){
                        $item->fridges = UserFridge::join('fridges', ['user_fridges.fridge_id' => 'fridges.id'])
                                        ->selectRaw('fridges.id, fridges.model, fridges.description, fridges.status')
                                        ->where(['store_id' => $item->id, 'user_fridges.status' => 'available'])
                                        ->where('fridges.is_pullout',0)
                                        ->get();
                        return $item;
                    });
        return response()->json( $stores);
    }

    public function staffClientStore(Request $request)
    {
        $client = User::join('stores', ['users.id' => 'stores.user_id'])
                        ->selectRaw('stores.*')
                        ->where([
                            // 'stores.user_id' => $request->user_id,
                            'stores.area_id' => $request->area_id
                        ])
                        ->get();

        return response()->json( $client );
    }

    public function getClientStore(Request $request){
        $store = Store::find($request->id);
        return response()->json( $store );
    }

    public function getStaffList(Request $request){
        $staff = User::where(['area_id' => $request->area_id])->first();
        return response()->json( $staff);
    }
}
