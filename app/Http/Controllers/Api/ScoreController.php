<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ScoreController extends Controller
{
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

    public function delete(Request $request, Student $student)
    {
        Gate::authorize('manage-score', [$student]);

        $student->subjects()->detach($request->subjects_id, ['subjects_id' => $request->subjects_id]);

        return response()->json([
            'message' => 'Удаление оценки  завершено.',
        ]);
    }

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
