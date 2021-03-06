<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostCon;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileCon;
use App\Http\Controllers\NewsfeedCon;
use App\Http\Controllers\FollowerFollwoingCon;
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
     return view('page');
 });
 Route::get('/imagefeed',[NewsfeedCon::class,'index']);

Auth::routes();

Route::get('/user/{user}', [HomeController::class, 'index'])->name('home');
Route::post('createpost',[HomeController::class,'createPost']);

Route::get('addpost',[PostCon::class,'index']);
Route::get('/p/{post}/',[PostCon::class,'show']);//for showing single picture
Route::get('/profile/{user}/edit',[ProfileCon::class,'edit']);
Route::patch('/profile/{user}',[ProfileCon::class,'update']);
//Route::get('/post/{user}', [PostCon::class,'find']);
Route::post('/user/{user}/following', [FollowerFollwoingCon::class, 'store'])->name('user.following');
