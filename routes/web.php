<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminMediasController;
use App\Http\Controllers\AdminCommentsController;

Route::get('/', function () {
    return view('welcome');
});

// 1. PUBLIC FRONTEND ROUTES (Open to everyone, no admin login required)
Route::get('/post/{id}', [AdminPostsController::class, 'post'])->name('home.post');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// 2. MAIN ADMIN ROUTES GROUP (Protected area for Admins only)
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.index');
        })->name('index');

        Route::resource('users', AdminUsersController::class);
        Route::resource('posts', AdminPostsController::class);
        Route::resource('categories', AdminCategoriesController::class);
        Route::resource('comments', AdminCommentsController::class);
        Route::resource('medias', AdminMediasController::class);

    });

require __DIR__.'/auth.php';
