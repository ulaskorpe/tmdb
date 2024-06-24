<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Cookie;
class AuthController extends Controller
{
    use HttpResponses;

    public function __construct(){
       
    }

    public function login(){
   
        if( Cookie::get('remember_me')){
             
            $user = User::where('remember_token', Cookie::get('remember_me'))->first();
       
            if ($user) {
                $user->email_verified_at = now();
                $user->save();
            Auth::login($user);
            }
              
        }
         
        if(!empty(Auth::user())){
            
             return redirect('admin-panel');
        }
        return view('login');
    }

 

 
    
    public function login_post(Request $request){
 
        if(!Auth::attempt(['admin_code' =>(integer)$request->admin_code, 'password' =>(string)$request->password])){
            return $this->error('','no such admin',200);
        }
        $remember=0;
        $user = User::where('admin_code',$request->admin_code)->first();
        if(!empty($request['remember_me'])) {
                $rememberToken = Str::random(60); // Generate a random token
                  Cookie::queue('remember_me', $rememberToken, 60*24*30);
                $user->remember_token = $rememberToken;
                $user->save();
                $remember=$request['remember_me'];
            }
        return  $this->success(['user'=>Auth::user(),'token'=>''],"Login successfull" ,200);
    }

    public function logout(Request $request){
        Cookie::queue('remember_me', '',0);
       //  Auth::user()->currentAccessToken()->delete();
        Auth::logout();
        //return $this->success('','logged out',200);
        return redirect('login');
    }
}
