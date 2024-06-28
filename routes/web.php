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
 
Route::get('/login',[AuthController::class,'login']);
Route::post('/login-post',[AuthController::class,'login_post'])->name('admin-login-post');

Route::group(['prefix'=>'admin-panel','middleware'=>\App\Http\Middleware\checkAdmin::class],function (){

    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
 
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/genre-list',[GenreController::class,'genreList'])->name('genre-list');  
    Route::group(['prefix'=>'movies'],function (){
        Route::get('/list',[MovieController::class,'movieList'])->name('movie-list');  
        Route::get('/search',[MovieController::class,'movieDetail'])->name('movie-search');  
        Route::get('/{slug}',[MovieController::class,'movieDetail'])->name('movie-detail');  
 

    });
 
    Route::group(['prefix'=>'series'],function (){

        Route::get('/list',[SeriesController::class,'test'])->name('series-list');  
        Route::get('/search',[SeriesController::class,'test'])->name('series-search');  
        Route::get('/{slug}',[SeriesController::class,'test'])->name('series-detail');

    });
});