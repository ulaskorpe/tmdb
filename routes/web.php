<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\DashboardController;
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
 

 


 
      
});