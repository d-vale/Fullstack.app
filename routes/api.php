<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\ProgressController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
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
    Route::middleware('auth:sanctum')->prefix('progress')->group(function () {
        Route::get('/', [ProgressController::class, 'getUserProgress']);
        Route::post('/update', [ProgressController::class, 'updateProgress']);
        Route::post('/reset', [ProgressController::class, 'resetProgress']);
    });

    // Admin routes - protected by authentication and admin middleware
    Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
        Route::get('/users/{userId}/progress', [ProgressController::class, 'getProgressByUserId']);
    });
});
