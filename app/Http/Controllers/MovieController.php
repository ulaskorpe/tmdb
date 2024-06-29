<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\TMDBService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MovieController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }


    public function clearSearch(Request $request)
    {
        Session::forget('search-result-ids');
        Session::forget('search-word');
        return response()->redirectTo('/admin-panel/movies');
    }

    public function movieList(){

        $result_ids = Session::get('search-result-ids');
        $keyword  = Session::get('search-word');

        $movies = Movie::with('genres')
        ->where('vote_count','>',1)
       ->orderBy('popularity','DESC')
         ->orderBy('vote_count','DESC')->orderBy('vote_average','DESC');

        if(!empty($result_ids)){
         
           $movies = $movies->whereIn('id',explode("@",$result_ids));
        }

         
      
         
         $movies = $movies->get();

        return view('panel.movies.list',['movies'=>$movies,'keyword'=>$keyword]);
    }

    public function movieDetail($slug){
    
      
        return view('panel.movies.detail',['movie'=>Movie::with('genres')->where('slug','=',$slug)->first()]);
    }

    public function movieSearch(){
        return view('panel.movies.search');
    }

    public function movieSearchPost(Request $request){
        $data = $this->tmdbService->searchFunction($request['keyword'],'movie');
        $result_array="";
        foreach($data['results'] as $result){
            $result_array .= $result['id']."@";
            $this->tmdbService->createUpdateMovie($result);
        }

        Session::put('search-result-ids', $result_array);
        Session::put('search-word', $request['keyword']);
        return response()->redirectTo('/admin-panel/movies');
            
    }
 
}
