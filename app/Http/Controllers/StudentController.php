<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Groups;
use App\Models\Students;
use App\Models\Subjects;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students  = Students::paginate(10);

        return view('students.index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Groups::pluck('id', 'name')->all();

        return view('students.create', [
            'groups' => $groups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        Students::create($request->validated());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $student)
    {
        $scores = collect();
        foreach ($student->subjects as $subject) {
            $scores[] = $subject->pivot->where(['subjects_id' => $subject->id])->first();
        }

        return view('students.show', [
            'student' => $student,
            'scores' => $scores
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $student)
    {
        $groups = Groups::pluck('id', 'name')->all();

        return view('students.edit', [
            'student' => $student,
            'groups' => $groups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Students $student)
    {
        $student->update($request->validated());

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $student)
    {
        $student->subjects()->detach();
        $student->delete();

        return back();
    }

    public function addScore(ScoreRequest $request, Students $student)
    {
        $request->validate;
        $student->subjects()->attach('students_id', [
            'score' => $request->score,
            'subjects_id' => $request->subject_id
        ]);

        return back();
    }


    public function showScore(Request $request, Students $student)
    {
        $subjectsAll = Subjects::all();
        $subjects = $student->subjects;
        $diffsubject = $subjectsAll->diff($subjects);

        return view('students.showscore', [
            'student' => $student,
            'subjects' => $diffsubject
        ]);
    }

    public function deleteScore(Request $request, Students $student)
    {
        $student->subjects()->detach(['subjects_id' => $request->subjects_id]);

        return back();
    }

    public function editScore(Request $request, Students $student)
    {
        $subject = Subjects::where('id', $request->subject_id)->first();

        return view('students.updateScore', [
            'student' => $student,
            'score' => $request->score,
            'subject' => $subject
        ]);
    }

    public function updateScore(Request $request, Students $student)
    {
        $student->subjects()->updateExistingPivot($student->id, [
            'score' => $request->score,
        ]);

        return redirect(route('students.index'));
    }
}
