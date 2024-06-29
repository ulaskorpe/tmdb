<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\TMDBService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }




    public function movieList(){
        return view('panel.movies.list',['movies'=>Movie::with('genres')
       ->where('vote_count','>',1)
      ->orderBy('popularity','DESC')
        ->orderBy('vote_count','DESC')->orderBy('vote_average','DESC')->get()]);
    }

    public function movieDetail($slug){
    
      
        return view('panel.movies.detail',['movie'=>Movie::with('genres')->where('slug','=',$slug)->first()]);
    }

    public function test(){

  //     //  Movie::where('id','>',0)->forceDelete();
  //       $data = $this->tmdbService->fetchSeries(2);

  //        foreach ($data['results'] as $data) {

  //           var_dump($data  );
  //           echo "<hr>";
  //  //        $this->tmdbService->createUpdateMovie($data);





  //        }
    }
}
