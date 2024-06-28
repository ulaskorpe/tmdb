<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['adult','title','original_title','original_language','overview', 'popularity','vote_average','vote_count', 'release_date', 'poster_path','backdrop_path'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie' );
    }
}

