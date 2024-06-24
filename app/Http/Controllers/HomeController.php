<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
 
use Session;
use App\Traits\HttpResponses;
use App\Models\Blog;
use App\Models\BlogImage;
use Carbon\Carbon;

class HomeController extends Controller
{

    use HttpResponses;
    public function index(){
        return response()->redirectTo('/login');
    }
    private function createSlug($string) {
        // Convert accented characters to their non-accented counterparts
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        
        // Replace non-alphanumeric characters with dashes
        $string = preg_replace('/[^a-zA-Z0-9\-]/', '-', $string);
        
        // Remove any consecutive dashes
        $string = preg_replace('/-+/', '-', $string);
        
        // Remove leading/trailing dashes
        $string = trim($string, '-');
        
        // Convert string to lowercase
        $string = strtolower($string);
        
        return $string;
    }

 
 

  

  

    private function createToken(User $user){
        $token = $user->createToken('API Token of'.$user->name)->plainTextToken;
        Session::put('token',$token);
        return $token;
    }

    public function login_post(Request $request){
        return json_encode([ $request ]);
      //  return response()->json("ok");
       //Log::channel('data_check')->info($request->admin_code);
        if(!Auth::attempt(['admin_code' => $request->admin_code, 'password' => $request->password])){
            return $this->error('','no such admin',401);
        }
            
        $user = User::where('admin_code',$request->admin_code)->first();
       
      return  $this->success(['user'=>$user,'token'=>$this->createToken($user)]);
    }

}
