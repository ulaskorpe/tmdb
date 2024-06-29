<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'adult', 'original_name','poster_path','backdrop_path'
    , 'origin_countries','original_language','overview','popularity','vote_average','vote_count','first_air_date'];

    
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_series_pivot_table' );
    }
}
 