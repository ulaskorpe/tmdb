<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDBService;

class FetchSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-series {pages=10}' ;
    protected $tmdbService;
    /**
     * The console command description.
     *
     * @var string
     */
 
     protected $description = 'each page gives 20 series data, creates or updates db series table';


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
        $pages = $this->argument('pages');
        $totalSeries = 0;

        $perPage = 20;
        $totalIterations = $pages * $perPage;

        $bar = $this->output->createProgressBar($totalIterations);

        $bar->start();

        for ($page = 1; $page <= $pages; $page++) {
            $data = $this->tmdbService->fetchPopularSeries($page);

            foreach ($data['results'] as $data) {

                $totalSeries++;
                 $this->tmdbService->createUpdateSeries($data);
                $bar->advance();


            }
        }

        $bar->finish();



        $this->info("\n series added to db : $totalSeries");
    }
}
