<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDBService;
use App\Models\Season;
class FetchEpisode extends Command
{  protected $tmdbService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'app:fetch-episodes {season_id=3625}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'saves / updates episodes of a given season of any series exists on db';
    public function __construct(TMDBService $tmdbService)
    {
        parent::__construct();
        $this->tmdbService = $tmdbService;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $season_id = $this->argument('season_id');
        $season = Season::find($season_id);
        if(!empty($season)){
            $data = $this->tmdbService->fetchSeriesSeasonsEpisodes($season['series_id'],$season['season_number']);
         
             foreach ($data['episodes'] as $data) {
                $this->tmdbService->createUpdateEpisode($data,$season['id']);
    
             }
        }else{
            $this->error('series not found');
        }
    }
}
