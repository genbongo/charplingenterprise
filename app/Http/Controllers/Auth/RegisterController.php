<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Store;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mail\SenderHelper as MailDispatch;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Traits\GlobalFunction;
class RegisterController extends Controller
{
    use GlobalFunction;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/pending';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_num' => ['required', 'string', 'max:255'],
            'area_id' => ['required', 'integer', 'max:255'],
            'store_name' => ['required', 'string', 'max:255'],
            'store_address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        if(User::where('email', $request->email)->first()){
            return response()->json([
                'status' => 'exist'
            ]);
        } else {
            $user_role = "2"; //means client/customer
            $is_pending = "1"; //means pending account

            $data_inserted_id = User::create([
                'fname'         => $request->fname,
                'mname'         => $request->mname,
                'lname'         => $request->lname,
                'address'       => $request->address,
                'contact_num'   => $request->contact_num,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'user_role'     => $user_role,
                'is_pending'    => $is_pending,
                'area_id'       => $request->area_id,
                'expiry'        => date('Y-m-d H:i:s', strtotime('+2 months'))
            ]);

            //set text message
            $text_message = "Hi, ". $request->fname . "\n \nThank you for registering as one of our retailers. Your details are going to be reviewed along with  your submitted requirements. Please wait for the updates and we will be back at you as soon as possible. 
            \nBest regards,\nCharpling Square Enterprise \nCreamline Authorized Distributor";

            //send it to customer
            $this->global_itexmo($request->contact_num, $text_message, "ST-CREAM343228_F3PNT", '8)tg(84@$$');

            new MailDispatch('registration', trim($request->email), array(
                'subject'   => 'Welcome to Charpling Square Enterprise',
                'title'     => 'Welcome to Charpling Square Enterprise', 
                "site"      => '',
                "name"      => trim($request->fname)
            ));
            
            Store::create([
                'store_name'        => $request->store_name,
                'store_address'     => $request->store_address,
                'user_id'           => $data_inserted_id->id,
                'area_id'           => $request->area_id,
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }
}
