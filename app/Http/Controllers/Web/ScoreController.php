<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreRequest;
use App\Models\Student;
use App\Models\Subject;
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

        return back();
    }

    public function create(Student $student)
    {
        Gate::authorize('manage-score', [$student]);

        $subject = Subject::whereNotIn('id', $student->subjects->pluck('id'))->get();

        return view('scores.create', [
            'student' => $student,
            'subjects' => $subject,
        ]);
    }

    public function delete(Request $request, Student $student)
    {
        Gate::authorize('manage-score', [$student]);

        $student->subjects()->detach($request->subjects_id, ['subjects_id' => $request->subjects_id]);

        return back();
    }

    public function edit(Request $request, Student $student)
    {
        Gate::authorize('manage-score', [$student]);

        $subject = Subject::where('id', $request->subject_id)->first();

        return view('scores.edit', [
            'student' => $student,
            'subject' => $subject,
        ]);
    }

    public function update(Request $request, Student $student)
    {
        Gate::authorize('manage-score', [$student]);

        $student->subjects()->where('subjects_id', $request->subjects_id)->updateExistingPivot($request->subjects_id, [
            'score' => $request->score,
        ]);

        return redirect(route('students.index'));
    }
}
