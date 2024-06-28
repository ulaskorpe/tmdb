<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use App\Http\Controllers\Helpers\GeneralHelper;
class FillSlugField extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-slug-field';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $movies = Movie::all();

        $bar = $this->output->createProgressBar($movies->count());

        $bar->start();

        foreach($movies as $movie){

            
            $movie->slug = GeneralHelper::makeSlug($movie->title);
            $movie->save();
            $bar->advance();

             
        }
        $bar->finish();
            echo "\n";
    }
}
