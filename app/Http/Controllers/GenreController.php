<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\GenreSeries;

class GenreController extends Controller
{
    public function genreList($type='movie'){


        return view('panel.genres',['genres'=> ($type == 'movie') ? Genre::all() : GenreSeries::all()]);
    }
   
}
