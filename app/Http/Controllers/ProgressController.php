<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Models\Choice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    /**
     * Get progress for the authenticated user
     *
     * @return JsonResponse
     */
    public function getUserProgress(): JsonResponse
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $progress = Progress::where('user_id', $user->id)
                ->orderBy('updated_at', 'desc')
                ->first();

            if (!$progress) {
                // If no progress found, return default initial values
                return response()->json([
                    'success' => true,
                    'data' => [
                        'public_trust' => 65,
                        'available_resources' => 100,
                        'social_impact' => 30,
                        'crisis_progress' => 15,
                        'current_chapter_id' => 1,
                        'completed' => false
                    ],
                    'message' => 'No progress found, returning default values'
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => array_merge($progress->toArray(), ['user_name' => $user->name])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user progress',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get progress for a specific user by ID (admin function)
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function getProgressByUserId(int $userId): JsonResponse
    {
        try {
            // Check if user exists
            $user = User::findOrFail($userId);

            $progress = Progress::where('user_id', $userId)
                ->orderBy('updated_at', 'desc')
                ->first();

            if (!$progress) {
                return response()->json([
                    'success' => false,
                    'message' => 'No progress found for this user'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $progress
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user progress',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update user progress based on a choice made
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProgress(Request $request): JsonResponse
    {
        try {
            // Validate the request
                $request->validate([
                'choice_id' => 'required|integer|exists:choices,id',
            ]);

            // Get the authenticated user
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Get the choice and its impacts
            $choice = Choice::findOrFail($request->choice_id);

            // Get current progress or create new one
            $progress = Progress::where('user_id', $user->id)->latest()->first();

            if (!$progress) {
                // Create a new progress record with default values
                $progress = new Progress([
                    'chapter_id' => 1,
                    'user_id' => $user->id,
                    'confiance' => 65,
                    'ressources' => 100,
                    'impact' => 30,
                    'crise' => 15,
                    'chapter_id' => 1,
                ]);
            }

            try {
                $progress->confiance = max(0, min(100, $progress->confiance + $choice->confiance));
                $progress->ressources = max(0, min(100, $progress->ressources + $choice->ressources));
                $progress->impact = max(0, min(100, $progress->impact + $choice->impact));
                $progress->crise = max(0, min(100, $progress->crise + $choice->crise));
                
                if($choice->next_chapter){
                    $progress->chapter_id = $choice->next_chapter;
                } else {
                    $progress->chapter_id = 16;
                }

                // Save the updated progress
                $progress->save();

                // Commit the transaction
                DB::commit();

                return response()->json([
                    'success' => true,
                    'data' => $progress,
                    'message' => 'Progress updated successfully'
                ]);
            } catch (\Exception $e) {
                // Rollback the transaction if something goes wrong
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update progress',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reset user progress
     *
     * @return JsonResponse
     */
    public function resetProgress(): JsonResponse
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $progress = Progress::where('user_id', $user->id)->latest()->first();

            $progress->chapter_id = 1;
            $progress->confiance = 65;
            $progress->ressources = 100;
            $progress->impact = 30;
            $progress->crise = 15;

            // Save the new progress
            $progress->save();

            return response()->json([
                'success' => true,
                'data' => $progress,
                'message' => 'Progress reset successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset progress',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
