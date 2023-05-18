<?php

namespace App\Http\Controllers\Web;

use App\Events\CreatedStudent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\StudentFilterRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Dictionaries\RoleDictionary;
use App\Models\Group;
use App\Models\Student;
use App\Services\FileServices;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentFilterRequest $request)
    {
        $this->authorize('viewAny', Student::class);

        $students = Student::filter($request)->paginate(10);

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
        $this->authorize('create', Student::class);

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
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RegisterStudentRequest $request)
    {
        $this->authorize('store', [Student::class, $request]);

        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home,
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
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Student $student)
    {
        $this->authorize('view', [$student]);

        $avatar = FileServices::getAvatarLink($student);

        $groups = Group::pluck('id', 'name')->all();

        return view('students.show', [
            'student' => $student,
            'groups' => $groups,
            'avatar' => $avatar,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $students
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Student $student)
    {
        $this->authorize('edit', [$student]);

        $avatar = FileServices::getAvatarLink($student);

        $groups = Group::pluck('id', 'name')->all();

        return view('students.edit', [
            'student' => $student,
            'groups' => $groups,
            'avatar' => $avatar,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $students
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Student $student, StudentRequest $request)
    {
        $this->authorize('update', [$student, $request]);

        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home,
        ];

        $student->address = $address;
        $student->update($request->validated());

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $students
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);

        $student->subjects()->detach();
        $student->delete();

        return back();
    }

    public function downloadList()
    {
        $this->authorize('create', Student::class);

        $students = Student::all();

        return FileServices::getStudentList($students);
    }

    public function restore(Student $student)
    {
        $this->authorize('restore', $student);

        $student->restore();

        return back();
    }

    public function forceDelete(Student $student)
    {
        $this->authorize('forceDelete', $student);

        $student->subjects()->detach();
        $student->forceDelete();

        return back();
    }
}
