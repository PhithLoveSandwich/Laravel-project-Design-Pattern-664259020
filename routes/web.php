<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::get('/', [PostController::class, 'index'])->name('home');

// จัดการโพสต์ (CRUD)
Route::resource('posts', PostController::class);

// จัดการคอมเมนต์
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


Route::get('/', [PostController::class, 'index'])->name('home');
Route::resource('posts', PostController::class);
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
