<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenreSeries extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name'];

    public function series()
    {
        return $this->belongsToMany(Series::class, 'genre_series_pivot_table' );
    }
}
