<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title', 'description', 'release_date', 'poster_path'];

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
}
