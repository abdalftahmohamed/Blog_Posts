<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

//****************posts/*******************************
Route::resource('/posts', PostController::class)->middleware('auth');
Route::delete('/posts.forcedelete',[PostController::class,'forcedelete'])->name('forcedelete');
Route::get('/posts.showdeleted',[PostController::class,'showdeleted'])->name('showdeleted');
Route::delete('/posts.restore',[PostController::class,'restore'])->name('restore');


//****************Comments/*******************************
Route::resource('/comments', CommentController::class)->middleware('auth');;

Auth::routes();
