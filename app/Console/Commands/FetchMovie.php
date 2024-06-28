<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDBService;


class FetchMovie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-movie {pages=50}';
    protected $tmdbService;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'each page gives 20 movie data, creates or updates db movies table';


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
        $totalMovie = 0;

        $perPage = 20;
        $totalIterations = $pages * $perPage;

        $bar = $this->output->createProgressBar($totalIterations);

        $bar->start();

        for ($page = 1; $page <= $pages; $page++) {
            $data = $this->tmdbService->fetchPopularMovies($page);

            foreach ($data['results'] as $data) {

                $totalMovie++;
                $this->tmdbService->createUpdateMovie($data);
                $bar->advance();


            }
        }

        $bar->finish();



        $this->info("\n movies added to db : $totalMovie");
    }
}
