<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Mail\PostLiked;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(UserPostController::class)->group(function () {
    Route::get('/user/{user:user_name}/posts', 'index')->name('userInfo');
});

Route::/*middleware('auth')->*/controller(PostController::class)->group(function () {
    Route::get('posts', 'index')->name('posts');
    Route::post('post', 'store')->name('storePost');
    Route::get('post/{post}', 'show')->name('post.show');
    Route::post('post/{post}/like', 'postLike')->name('mLike');
    Route::post('post/{post}/unlike', 'postUNLike')->name('unLike');
    Route::delete('post/{post}/delete', 'delete')->name('postDel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';