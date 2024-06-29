<?php

namespace App\Http\Controllers;
use App\Services\TMDBService;
use Illuminate\Http\Request;
use App\Models\Series;
class SeriesController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function seriesDetail($slug){
   
        return view('panel.series.detail',['series'=>Series::with('genres','seasons')->where('slug','=',$slug)->first()]);
    }


    public function seriesList(){
        return view('panel.series.list',['series'=>Series::with('genres')
       ->where('vote_count','>',1)
      ->orderBy('popularity','DESC')
        ->orderBy('vote_count','DESC')->orderBy('vote_average','DESC')->get()]);
    }
}
