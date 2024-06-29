<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDBService;
use App\Models\Series;
class FetchSeason extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-seasons {series_id=1399}';
    protected $tmdbService;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'saves / updates seasons of a given series exists on db';
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
        $series_id = $this->argument('series_id');
        $series = Series::find($series_id);
        if(!empty($series)){
            // $this->info($series['name']);
            // echo "\n";
            $data = $this->tmdbService->fetchSeriesSeasons($series_id);
            foreach($data['seasons'] as $season){
               // echo $season['name']."\n";
                $this->tmdbService->createUpdateSeason($season,$series_id);
            }
        }else{
            $this->error('series not found');
        }
    }
}
