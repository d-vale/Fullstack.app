<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChoiceController extends Controller
{
    /**
     * Get a specific choice by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getChoice(int $id): JsonResponse
    {
        try {
            $choice = Choice::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $choice
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Choice not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get impacts for a specific choice
     *
     * @param int $choiceId
     * @return JsonResponse
     */
    public function getChoiceImpacts(int $choiceId): JsonResponse
    {
        try {
            $choice = Choice::with('impacts')->findOrFail($choiceId);

            return response()->json([
                'success' => true,
                'data' => $choice->impacts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve impacts for this choice',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get the next chapter for a specific choice
     *
     * @param int $choiceId
     * @return JsonResponse
     */
    public function getNextChapter(int $choiceId): JsonResponse
    {
        try {
            $choice = Choice::findOrFail($choiceId);
            $nextChapterId = $choice->chapter_id + 1;

            $nextChapter = Chapter::find($nextChapterId);

            if (!$nextChapter) {
                return response()->json([
                    'success' => false,
                    'message' => 'Next chapter not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $nextChapter
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve next chapter',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
