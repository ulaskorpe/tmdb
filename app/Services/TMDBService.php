<?php
namespace App\Services;

use App\Http\Controllers\Helpers\GeneralHelper;
use GuzzleHttp\Client;
use App\Models\Genre;
use App\Models\GenreSeries;
use App\Models\Movie;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;


class TMDBService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
        ]);
    }

    public function fetchMovie($id)
    {
        $response = $this->client->get("movie/{$id}", [
            'query' => ['api_key' => env('TMDB_API_KEY')]
        ]);

        return json_decode($response->getBody(), true);
    }
    public function fetchPopularMovies($page)
    {
        $response = $this->client->get("movie/popular", [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
                'sort_by' => 'popularity.desc',  
                'page' => $page
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function fetchGenres($type='movie')
    {
        $response = $this->client->get("genre/".$type."/list", [
            'query' => ['api_key' => env('TMDB_API_KEY')]
        ]);

        return json_decode($response->getBody(), true);
    }

 

    public function fetchPopularSeries($page)
    {
        $response = $this->client->get("discover/tv", [
            'query' => ['api_key' => env('TMDB_API_KEY'),
            'sort_by' => 'popularity.desc',  
            'page' => $page,  
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function fetchSeriesSeasons($seriesId)
    {

        $response = $this->client->get("tv/".$seriesId, [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
            ]
        ]);

    

        return json_decode($response->getBody(), true);
    }


    public function fetchSeriesSeasonsEpisodes($seriesId,$season_number)
    {

        $response = $this->client->get("tv/".$seriesId."/season/".$season_number, [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
            ]
        ]);

    

        return json_decode($response->getBody(), true);
    }


    public function createUpdateEpisode($data,$season_id){
        $episode = Episode::find($data['id']);
        if(empty($episode)){
            $episode = new Episode();
            $episode->id  = $data['id'];
            $episode->season_id  =$season_id;
           
        }

        $episode->name = $data['name'];
        $episode->slug = GeneralHelper::makeSlug($data['name']);
        $episode->episode_number = $data['episode_number'];
        $episode->overview = $data['overview'];
        $episode->season_number = $data['season_number'];
        $episode->production_code = intval( $data['production_code']);
        $episode->episode_type = $data['episode_type'];
        $episode->vote_average = $data['vote_average'];
        $episode->vote_count = $data['vote_count'];
        $episode->runtime = (!empty($data['runtime']))?intval($data['runtime']):0;
        $episode->air_date = (!empty($data['air_date'])) ? $data['air_date'] : '2024-01-01';
        $episode->still_path = $data['still_path'];
        $episode->save();

    }

    public function createUpdateGenre($data,$type='movie'){
        if($type == 'movie'){
        Genre::updateOrCreate(
            ['id' => $data['id']],
            ['name' => $data['name']]
        );
        }else{
            $gs = GenreSeries::find($data['id']);
            if(empty($gs)){
                $gs = new GenreSeries();
                $gs->id = $data['id'];
            }
            $gs->name = $data['name'];
            $gs->save();
        }
    }
   
    private function verifyArray($array,$type='movie'){
        $new_array = [];
        foreach($array as $genre_id){
            if($type == 'movie'){
                $g = Genre::find($genre_id);
            }else{
                $g = GenreSeries::find($genre_id);
            }

            if(!empty($g)){
            $new_array[] = $genre_id;
                }
        }
        return $new_array;
    }

    public function createUpdateSeries($data){
        $series = Series::find($data['id']);
        if(empty($series )){
            $series = new Series();
            $series->id = $data['id'];
        }
        $series->name = $data['name'];
        $series->slug = GeneralHelper::makeSlug($data['name']);
        $series->adult = ($data['adult'])?1:0;
        $series->overview = $data['overview'];
        $series->original_name = $data['original_name'];
        $series->popularity = $data['popularity'];
        $series->vote_average = $data['vote_average'];
        $series->vote_count = $data['vote_count'];
        $series->first_air_date = (!empty($data['first_air_date'])) ? $data['first_air_date'] : '2024-01-01';
        $series->poster_path = $data['poster_path'];
        $series->backdrop_path = $data['backdrop_path'];
        $series->original_language = $data['original_language'];
        $series->save();

        $this->attachSeriesToGenres($series, $this->verifyArray( $data['genre_ids'],'tv'));
        return  $series->with('genres');

    }

    public function createUpdateSeason($data,$series_id){
            $season = Season::find($data['id']);
            if(empty($season)){
                $season = new Season();
                $season->id = $data['id'];
                $season->series_id = $series_id;
            }
            $season->name = $data['name'];
            $season->overview = $data['overview'];
            $season->slug = GeneralHelper::makeSlug($data['name']);
            $season->episode_count = $data['episode_count'];
            $season->season_number = $data['season_number'];
            $season->poster_path = $data['poster_path'];
            $season->vote_average = $data['vote_average'];
            $season->air_date = (!empty($data['air_date'])) ? $data['air_date'] : '2024-01-01';
            $season->save();
    }   
    public function createUpdateMovie($data){

        $movie = Movie::find($data['id']);
        if(empty($movie )){
            $movie = new Movie();
            $movie->id = $data['id'];
        }
        $movie->title = $data['title'];
        $movie->adult = ($data['adult'])?1:0;
        $movie->slug = GeneralHelper::makeSlug($data['title']);
        $movie->overview = $data['overview'];
        $movie->original_title = $data['original_title'];
        $movie->popularity = $data['popularity'];
        $movie->vote_average = $data['vote_average'];
        $movie->vote_count = $data['vote_count'];
        $movie->release_date = (!empty($data['release_date'])) ? $data['release_date'] : '2024-01-01';
        $movie->poster_path = $data['poster_path'];
        $movie->backdrop_path = $data['backdrop_path'];
        $movie->original_language = $data['original_language'];
        $movie->save();


        $this->attachMovieToGenres($movie,$this->verifyArray( $data['genre_ids'],'movie'));
        return  $movie->with('genres');


    }


    private function attachMovieToGenres(Movie $movie, $genre_ids) {
        $movie->genres()->detach();
        $movie->genres()->attach($genre_ids);
    }

    private function attachSeriesToGenres(Series $series, $genre_ids) {
        $series->genres()->detach();
        $series->genres()->attach($genre_ids);
    }
}
