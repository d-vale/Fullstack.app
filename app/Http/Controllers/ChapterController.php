<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChapterController extends Controller
{
    /**
     * Get all chapters for the crisis simulation
     *
     * @return JsonResponse
     */
    public function getAllChapters(): JsonResponse
    {
        try {
            $chapters = Chapter::orderBy('order', 'asc')->get();

            return response()->json([
                'success' => true,
                'data' => $chapters
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve chapters',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a specific chapter by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getChapter(int $id): JsonResponse
    {
        try {
            $chapter = Chapter::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $chapter
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Chapter not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get choices for a specific chapter
     *
     * @param int $chapterId
     * @return JsonResponse
     */
    public function getChapterChoices(int $chapterId): JsonResponse
    {
        try {
            $chapter = Chapter::with('choices')->findOrFail($chapterId);

            return response()->json([
                'success' => true,
                'data' => $chapter->choices
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve choices for this chapter',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get all ending chapters (is_final = true)
     *
     * @return JsonResponse
     */
    public function getEndingChapters(): JsonResponse
    {
        try {
            $endingChapters = Chapter::where('is_final', true)->get();

            return response()->json([
                'success' => true,
                'data' => $endingChapters
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve ending chapters',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the first chapter (entry point to the story)
     *
     * @return JsonResponse
     */
    public function getFirstChapter(): JsonResponse
    {
        try {
            $firstChapter = Chapter::where('order', 1)->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $firstChapter
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'First chapter not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
