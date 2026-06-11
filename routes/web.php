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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Main Admin routes group (Combined auth AND your custom admin middleware here)
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.index');
        })->name('index');

        // 1. Fully Implemented Sections
        Route::resource('users', AdminUsersController::class);

        Route::resource('posts', AdminPostsController::class);

        // 2. Uncreated Sections (Temporary Fallbacks - Built to prevent 500 naming crashes)

        // ── CATEGORIES FALLBACKS ──
        Route::get('/categories', function () {
            return view('errors.404');
        })->name('categories.index');

        Route::get('/categories/create', function () {
            return view('errors.404');
        })->name('categories.create');

        // ── MEDIA FALLBACKS ──
        Route::get('/medias', function () {
            return view('errors.404');
        })->name('medias.index');

        Route::get('/medias/create', function () {
            return view('errors.404');
        })->name('medias.create');

        // ── COMMENTS FALLBACKS ──
        Route::get('/comments', function () {
            return view('errors.404');
        })->name('comments.index');
    });

require __DIR__.'/auth.php';
