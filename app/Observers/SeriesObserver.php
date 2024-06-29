<?php

namespace App\Observers;

use App\Models\Series;
use Illuminate\Support\Facades\Artisan;
class SeriesObserver
{
    public function saved(Series $series){
        Artisan::call('app:fetch-seasons '.$series['id']);
    }
}
