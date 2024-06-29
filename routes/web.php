<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;



use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SeriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
Route::get('/',[HomeController::class, 'index']);
Route::get('/test',[HomeController::class, 'test']);
 
Route::get('/login',[AuthController::class,'login']);
Route::post('/login-post',[AuthController::class,'login_post'])->name('admin-login-post');

Route::group(['prefix'=>'admin-panel','middleware'=>\App\Http\Middleware\checkAdmin::class],function (){

    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
 
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/genre-list/{type}',[GenreController::class,'genreList'])->name('genre-list');  
    
    Route::group(['prefix'=>'movies'],function (){
        Route::get('/',[MovieController::class,'movieList'])->name('movie-list');  
       Route::get('/search',[MovieController::class,'movieSearch'])->name('movie-search');  
       Route::post('/search-post',[MovieController::class,'movieSearchPost'])->name('movie-search-post');  
       Route::post('/clear-search-post',[MovieController::class,'clearSearch'])->name('movie-search-clear');  
       Route::get('/detail/{slug}',[MovieController::class,'movieDetail'])->name('movie-detail');  
       Route::get('/search-results',[MovieController::class,'searchResults'])->name('search-movie-results');  
 

    });
 
    Route::group(['prefix'=>'series'],function (){

        Route::get('/',[SeriesController::class,'seriesList'])->name('series-list');  
        Route::get('/search',[SeriesController::class,'seriesSearch'])->name('series-search');  
        Route::post('/search-post',[SeriesController::class,'seriesSearchPost'])->name('series-search-post');  
        Route::post('/clear-search-post',[SeriesController::class,'clearSearch'])->name('series-search-clear');  
        Route::get('/detail/{slug}',[SeriesController::class,'seriesDetail'])->name('series-detail');
        Route::get('/episode-list/{season_id}',[SeriesController::class,'episodeList'])->name('episode_list');

    });
});