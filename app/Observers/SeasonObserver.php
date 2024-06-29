<?php

namespace App\Observers;
use App\Models\Season;
use Illuminate\Support\Facades\Artisan;
class SeasonObserver
{
    public function saved(Season $season){
       // Artisan::call('app:fetch-episodes '.$season['id']);
    }
}
