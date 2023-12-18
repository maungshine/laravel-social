<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/registerUser', [AuthController::class, 'store'])->name('registerUser');

Route::post('/loginUser', [AuthController::class, 'loginUser'])->name('loginUser');

Route::post('/searchPosts', [HomeController::class, 'search'])->name('searchPosts');



Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/viewProfile/{user}', [ProfileController::class, 'viewProfile'])->name('viewProfile');

    Route::get('/followingFeeds', [HomeController::class, 'followingFeeds'])->name('followingFeeds');

    Route::resource('post', PostController::class);

    Route::post('/upload_profile', [ProfileController::class, 'upload'])->name('upload');

    Route::get('/edit_profile', [ProfileController::class, 'edit'])->name('profileEdit');

    Route::post('/commentPost/{post_id}/{user_id}', [CommentController::class, 'commentPost'])->name('commentPost');

    Route::post('/likePost/{post}/{user}', [LikeController::class, 'likePost'])->name('likePost');

    Route::post('/unlikePost/{post}/{user}', [LikeController::class, 'unlikePost'])->name('unlikePost');

    Route::post('/follow/{user}', [FollowerController::class, 'follow'])->name('follow');

    Route::post('/unfollow/{user}', [FollowerController::class, 'unfollow'])->name('unfollow');

});