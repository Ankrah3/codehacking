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

        Route::resource('categories', AdminCategoriesController::class);

        // 2. Comments Section Placeholder
        Route::get('comments', function () {
            return 'Comments Section Coming Soon!';
        })->name('comments.index');

        // 3. Media Section Fix (Since you have the controller imported, map it here)
        Route::resource('medias', AdminMediasController::class);

        /* NOTE: If your AdminMediasController doesn't have its methods built yet,
           you can comment out the resource route above and use these temporary placeholders instead:

           Route::get('medias', function () { return 'Media Index Coming Soon!'; })->name('medias.index');
           Route::get('medias/create', function () { return 'Media Upload Coming Soon!'; })->name('medias.create');
        */

    });

require __DIR__.'/auth.php';
