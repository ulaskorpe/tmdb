<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDBService;


class FetchGenres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-genres';

    protected $tmdbService;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fills the genre table ';
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
        $data = $this->tmdbService->fetchGenres();
        $count = count($data['genres']);
        $bar = $this->output->createProgressBar($count);

        $bar->start();
        foreach ($data['genres'] as $data) {
           $this->tmdbService->createUpdateGenre($data);
           $bar->advance();

        }
        $bar->finish();
        $this->info("\n".$count. " added to db" );

    }
}
