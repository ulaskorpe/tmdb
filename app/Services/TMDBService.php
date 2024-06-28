<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Genre;
use App\Models\Movie;
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
                'page' => $page
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function fetchGenres()
    {
        $response = $this->client->get("genre/movie/list", [
            'query' => ['api_key' => env('TMDB_API_KEY')]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function fetchSeries($page)
    {
        $response = $this->client->get("discover/tv", [
            'query' => ['api_key' => env('TMDB_API_KEY'),
            'sort_by' => 'popularity.desc', // Sort by popularity descending
            'page' => $page, // Page number
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function createUpdateGenre($data){
        Genre::updateOrCreate(
            ['id' => $data['id']],
            ['name' => $data['name']]
        );
    }
    public function fetchSeriesWithSeasonsAndEpisodes($seriesId)
    {
        $response = $this->client->get("tv/{$seriesId}?api_key={$this->apiKey}&append_to_response=seasons");

        if ($response->getStatusCode() === 200) {
            $series = json_decode($response->getBody(), true);

            // Fetch episodes for each season
            foreach ($series['seasons'] as &$season) {
                $seasonResponse = $this->client->get("tv/{$seriesId}/season/{$season['season_number']}?api_key={$this->apiKey}");
                $season['episodes'] = json_decode($seasonResponse->getBody(), true)['episodes'];
            }

            return $series;
        }

        return null;
    }

    public function createUpdateMovie($data){

        $movie = Movie::find($data['id']);
        if(empty($movie )){
            $movie = new Movie();
            $movie->id = $data['id'];
        }
        $movie->title = $data['title'];
        $movie->adult = ($data['adult'])?1:0;
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


        $this->attachMovieToGenres($movie,$data['genre_ids']);
        return  $movie->with('genres');


    }


    private function attachMovieToGenres(Movie $movie, $genre_ids) {
        $movie->genres()->detach();
        $movie->genres()->attach($genre_ids);
    }
}
