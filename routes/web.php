<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;

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

Route::get('/', function () {
    return view('welcome');
});
// auth
Route::middleware('guest')->controller(AuthenticationController::class)->group(function(){
    Route::get('/login','create')->name('create');
    Route::post('/login','login')->name('login');
    Route::get('/register','register')->name('register');
    Route::post('/register','store')->name('store');
});
Route::middleware(['auth'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard','dashboard')->name('dashboard');
        Route::post('/logout','logout')->name('logout');
    });
    Route::get('/test',function(){
        return 'admin test';
    })->middleware('can:isSuperadmin'); // it is route gate
    // post
    Route::controller(PostController::class)->prefix('post')->name('post.')->group(function(){
        Route::get('/index','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/show/{slug}','show')->name('show');
        Route::get('/edit/{slug}','edit')->name('edit')->middleware('can:isSuperadmin');
        Route::put('/update/{slug}','update')->name('update')->middleware('can:isSuperadmin');
        Route::delete('/destroy/{slug}','destroy')->name('destroy')->middleware('can:isSuperadmin');

        Route::get('/trash','trash')->name('trash');
        Route::get('/restore/{slug}','restore')->name('restore')->middleware('can:isSuperadmin');
        Route::delete('/forceDelete/{slug}','forceDelete')->name('forceDelete')->middleware('can:isSuperadmin');
    });
});
