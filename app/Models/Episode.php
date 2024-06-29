<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['season_id', 'episode_number', 'production_code','name','slug','episode_type',
    'vote_average','vote_count' ,'runtime',   
    'overview', 'air_date', 'still_path'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}


 