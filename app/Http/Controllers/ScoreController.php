<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreRequest;
use App\Models\Students;
use App\Models\Subjects;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function store(ScoreRequest $request, Students $student)
    {
        $student->subjects()->attach($request->subject_id, [
            'score' => $request->score,
            'subject_id' => $request->subject_id
        ]);

        return back();
    }


    public function create(Students $student)
    {
        $subject = Subjects::whereNotIn('id', $student->subjects->pluck('id'))->get();

        return view('scores.create', [
            'student' => $student,
            'subjects' => $subject
        ]);
    }

    public function delete(Request $request, Students $student)
    {
        $student->subjects()->detach($request->subjects_id, ['subjects_id' => $request->subjects_id]);

        return back();
    }

    public function edit(Request $request, Students $student)
    {
        $subject = Subjects::where('id', $request->subject_id)->first();

        return view('scores.edit', [
            'student' => $student,
            'subject' => $subject
        ]);
    }

    public function update(Request $request, Students $student)
    {
        $student->subjects()->where('subjects_id', $request->subjects_id)->updateExistingPivot($request->subjects_id, [
            'score' => $request->score,
        ]);

        return redirect(route('students.index'));
    }
}
