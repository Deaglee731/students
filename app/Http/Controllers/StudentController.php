<?php

namespace App\Http\Controllers;

use App\Events\CreatedStudent;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\StudentFilterRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Dictionaries\RoleDictionary;
use App\Models\Group;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentFilterRequest $request)
    {
        $students  = Student::filter($request)->paginate(10);

        return view('students.index', [
            'students' => $students,
            'request' => $request->validated(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::pluck('id', 'name')->all();
        $roles = RoleDictionary::getDictionary();

        return view('students.create', [
            'groups' => $groups,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterStudentRequest $request)
    {   
        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home
        ];

        $user = Student::create($request->validated());
        $user->address = $address;

        event(new CreatedStudent($user));

        $user->password = bcrypt($user->password);
        $user->save();

        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.show', [
            'student' => $student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $groups = Group::pluck('id', 'name')->all();

        return view('students.edit', [
            'student' => $student,
            'groups' => $groups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home
        ];

        $student->address = $address;
        $student->update($request->validated());

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->subjects()->detach();
        $student->delete();

        return back();
    }
}
