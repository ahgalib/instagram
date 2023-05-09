<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostCon;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileCon;
use App\Http\Controllers\NewsfeedCon;
use App\Http\Controllers\FollowerFollwoingCon;
use App\Http\Controllers\CommentCon;
use App\Http\Controllers\GithubCon;
use App\Http\Controllers\GoogleCon;
use App\Http\Controllers\PasswordResetCon;




//instagram news feed
Route::get('/',[NewsfeedCon::class,'index']);

Auth::routes();

Route::get('/user/{user}', [HomeController::class, 'index']);

//post route
Route::post('createpost',[HomeController::class,'createPost']);
Route::get('addpost',[PostCon::class,'index']);
Route::get('/p/{post}/',[PostCon::class,'show']);//for showing single picture
Route::get('post/edit/{id}',[PostCon::Class,'show_edit_page'])->name('post.edit');
Route::post('post/save/{id}',[PostCon::Class,'save_edit_post'])->name('save.post.edit');

//create profile
Route::get('/profile/create',[ProfileCon::class,'create_profile'])->name('profile.create')->middleware(['profileMiddleware']);
Route::post('/profile/create/save',[ProfileCon::class,'save_create_profile'])->name('save.profile.create');
Route::get('/profile/{user}/edit',[ProfileCon::class,'edit']);
Route::patch('/profile/{id}',[ProfileCon::class,'update']);
//Route::get('/post/{user}', [PostCon::class,'find']);


//follow unfollow route
Route::post('/user/{user}/following', [FollowerFollwoingCon::class, 'store'])->name('user.following');
Route::post('/user/profile/{profile}/unfollow', [FollowerFollwoingCon::class, 'unfollow'])->name('user.unfollow');

//like and unlike  route
Route::post('/post/{id}/like',[PostCon::class,'like']);
Route::post('/post/{id}/unlike',[PostCon::class,'unlike']);

//ajax like
// Route::post('/ajax/like',[PostCon::class,'ajax_like']);

//comment
Route::get('post/comment/{post}',[CommentCon::class,'show']);
Route::post('post/comment/save',[CommentCon::class,'create'])->name('comment.create');

//logout
Route::get('/ins/jkkjkjsd/kksdf',[ProfileCon::class,'logout'])->name('insta.logout');

//github login
Route::get('github/redirect',[GithubCon::class,'redirect_to_provider'])->name('github.redirect');
Route::get('github/callback',[GithubCon::class,'provider_to_application'])->name('github.callback');

//google login
Route::get('google/redirect',[GoogleCon::class,'redirect_to_provider'])->name('google.redirect');
Route::get('google/callback',[GoogleCon::class,'provider_to_application'])->name('google.callback');

//password reset
Route::get('password/forget/form',[PasswordResetCon::class,'forget_password'])->name('password.forget.form');
Route::post('password/reset/email/send',[PasswordResetCon::class,'forget_password_email_send'])->name('user_password_reset_email_send');
Route::get('reset/password/form/{token}',[PasswordResetCon::class,'reset_password_form']);
Route::post('set/new/password',[PasswordResetCon::class,'set_new_password']);
