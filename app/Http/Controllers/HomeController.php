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
use App\Services\TMDBService;

class HomeController extends Controller
{

    use HttpResponses;


    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
       // $this->tmdbService = $tmdbService;
    }

    public function index(){
        return response()->redirectTo('/login');
    }


 
 
 

  

 

}
