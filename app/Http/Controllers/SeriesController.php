<?php

namespace App\Http\Controllers;
use App\Services\TMDBService;
use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Facades\Session;
class SeriesController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function seriesDetail($slug){
        $series = Series::with('genres','seasons')->where('slug','=',$slug)->first();
        $seasons = $series->seasons->toArray();
        usort($seasons, function ($a, $b) {
            return $a['season_number'] <=> $b['season_number'];
        });
        
       
        return view('panel.series.detail',['series'=>$series,'seasons'=>$seasons]);
    }

    public function clearSearch(Request $request)
    {
        Session::forget('search-series-ids');
        Session::forget('search-series-word');
        return response()->redirectTo('/admin-panel/series');
    }



    public function seriesList(){
      
        $result_ids = Session::get('search-series-ids');
        $keyword  = Session::get('search-series-word');


        $series = Series::with('genres')
        ->where('vote_count','>',1)
       ->orderBy('popularity','DESC')
         ->orderBy('vote_count','DESC')->orderBy('vote_average','DESC') ;

         if(!empty($result_ids)){
            $series = $series->whereIn('id',explode("@",$result_ids));
         }
         
          $series = $series->get();

        return view('panel.series.list',['series'=>$series,'keyword'=>$keyword]);
    }

    public function episodeList($season_id){
        $this->updateEpisodes($season_id);
       return view('panel.series.episodes',['episodes'=>Episode::with('season')->where('season_id','=',$season_id)->orderby('episode_number')->get()]);

    }


    private function updateEpisodes($season_id){
        $season = Season::find($season_id);
        $data = $this->tmdbService->fetchSeriesSeasonsEpisodes($season['series_id'],$season['season_number']);
        foreach ($data['episodes'] as $data) {
       
           $this->tmdbService->createUpdateEpisode($data,$season_id);
          

        }
        
    }

    public function seriesSearch(){
        return view('panel.series.search');
    }

    public function seriesSearchPost(Request $request){
        $data = $this->tmdbService->searchFunction($request['keyword'],'tv');
         
        $result_array="";
        foreach($data['results'] as $result){
           
             $result_array .= $result['id']."@";
            // $this->tmdbService->createUpdateSeries($result);
        }
        
        Session::put('search-series-ids', $result_array);
        Session::put('search-series-word', $request['keyword']);
      
      
        return response()->redirectTo('/admin-panel/series');
            
    }
}
