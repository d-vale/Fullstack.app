<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\ProgressController;

Route::get('/', function () {
    return view('vue');
})->middleware(['auth', 'verified'])->name('start');

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});


// API version 1 routes
Route::prefix('v1')->group(function () {
    // Chapters routes
    Route::prefix('chapters')->group(function () {
        Route::get('/', [ChapterController::class, 'getAllChapters']);
        Route::get('/first', [ChapterController::class, 'getFirstChapter']);
        Route::get('/endings', [ChapterController::class, 'getEndingChapters']);
        Route::get('/{id}', [ChapterController::class, 'getChapter']);
        Route::get('/{chapterId}/choices', [ChapterController::class, 'getChapterChoices']);
    });

    // Choices routes
    Route::prefix('choices')->group(function () {
        Route::get('/{id}', [ChoiceController::class, 'getChoice']);
        Route::get('/{choiceId}/impacts', [ChoiceController::class, 'getChoiceImpacts']);
        Route::get('/{choiceId}/next-chapter', [ChoiceController::class, 'getNextChapter']);
    });

    // Progress routes - protected by authentication
    Route::middleware('auth')->prefix('progress')->group(function () {
        Route::get('/', [ProgressController::class, 'getUserProgress']);
        Route::patch('/update', [ProgressController::class, 'updateProgress']);
        Route::patch('/reset', [ProgressController::class, 'resetProgress']);
    });

    // Admin routes - protected by authentication and admin middleware
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
        Route::get('/users/{userId}/progress', [ProgressController::class, 'getProgressByUserId']);
    });
});

require __DIR__.'/auth.php';
