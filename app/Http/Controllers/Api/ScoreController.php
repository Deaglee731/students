<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ScoreController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/students/{student}/addScore/",
     *     description="Groups store",
     *     tags={"score"},
     *     @OA\Parameter(
     *          required=true,
     *          name="student_id",
     *          description="Student id",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="score",
     *          description="Score",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="subject_id",
     *          description="Subject",
     *          in="query",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Score create sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Score"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function store(ScoreRequest $request, Student $student)
    {
        Gate::authorize('manage-score', [$student]);

        $student->subjects()->attach($request->subject_id, [
            'score' => $request->score,
            'subject_id' => $request->subject_id,
        ]);

        return response()->json([
            'message' => 'Добавление оценки завершено.',
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/students/{student}/deleteScore/",
     *     description="Score delete",
     *     tags={"score"},
     *     @OA\Parameter(
     *          required=true,
     *          name="student",
     *          description="Student_id",
     *          in="path",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="subject_id",
     *          description="Subject id",
     *          in="query",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Score delete sucessfull",
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function delete(Request $request, Student $student)
    {
        Gate::authorize('manage-score', [$student]);

        $student->subjects()->detach($request->subjects_id, ['subjects_id' => $request->subjects_id]);

        return response()->json([
            'message' => 'Удаление оценки  завершено.',
        ]);
    }

        /**
     * @OA\Patch(
     *     path="/api/students/{student}/updateScore",
     *     description="Score Update",
     *     tags={"score"},
     *     @OA\Parameter(
     *          required=true,
     *          name="student_id",
     *          description="Student id",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="score",
     *          description="Score",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="subject_id",
     *          description="Subject",
     *          in="query",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Score update sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Score"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function update(Request $request, Student $student)
    {
        Gate::authorize('manage-score', [$student]);

        $student->subjects()->where('subjects_id', $request->subjects_id)->updateExistingPivot($request->subjects_id, [
            'score' => $request->score,
        ]);

        return response()->json([
            'message' => 'Обновление оценки завершено.',
        ]);
    }
}
