<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
class AuthController extends Controller
{
    public function rejectAuth($request){
        Auth::logout();
    }
     // do login Auth
     public function loginUser(Request $request)
     {
        $email	       = $request->email;
        $password      = $request->password;
        $rememberToken = $request->remember_me == 1 ? true : false;
        if (Auth::attempt(['email' => $email, 'password' => $password], $rememberToken)) {
            if($user = User::where('email', $email)->first()){
                if($user->is_pending == 1 || $user->is_active == 0){
                    $this->rejectAuth($request);
                    $response = ['status'=>'failed', 'message' => 'Your account is currently deactivated.'];
                } else {
                    $response = ['status'=>'success', 'message' => 'Login Successful'];
                }
            }
         } 
         else {
            $this->rejectAuth($request);
            $response = ['status'=>'failed', 'message' => 'These credentials do not match our records.'];
         }
         return response()->json($response);
     }
}
