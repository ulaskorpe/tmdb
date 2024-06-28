<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
class GenreController extends Controller
{
    public function genreList(){
        return view('panel.genres',['genres'=>Genre::all()]);
    }
}
