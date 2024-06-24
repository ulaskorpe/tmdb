<?php

namespace App\Http\Controllers\Helpers;

use GuzzleHttp\Client;

class TMDBHelper {

    protected $client;
    protected $apiKey;
    protected $baseUri;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('TMDB_API_KEY');
        $this->baseUri = 'https://api.themoviedb.org/3/';
    }

    public function getData($query,$path = 'movie/popular', $keyword = null,$page = 0)
    {
        $response = $this->client->get($this->baseUri . $path, [
            // 'query' => [
            //     'api_key' => $this->apiKey,
            //     'query' => $query
            // ]
            $query => $this->buildQuery()
        ]);

        return json_decode($response->getBody(), true);
    }

    private function buildQuery($keyword = null , $page = 0){

    }
}