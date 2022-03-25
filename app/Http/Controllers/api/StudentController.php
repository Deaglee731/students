<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\StudentFilterRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\FileServices;

class StudentController extends Controller
{
    public function index(StudentFilterRequest $request)
    {
        $this->authorize('viewAny', Student::class);

        $students = Student::filter($request)->paginate(10);

        return StudentResource::collection($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
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
        $user->password = bcrypt($user->password);
        $user->save();


        return new StudentResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $students
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $this->authorize('view', [$student]);

        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $students
     *
     * @return \Illuminate\Http\Response
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

        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $students
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);

        $student->subjects()->detach();
        $student->delete();

        return response()->json([
            'message' => 'Удаление завершено.',
        ]);
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

       return response()->json([
            'message' => 'Восстановление завершено.',
        ]);
    }

    public function forceDelete(Student $student)
    {
        $this->authorize('forceDelete', $student);

        $student->subjects()->detach();
        $student->forceDelete();

        return response()->json([
            'message' => 'Полное удаление завершено.',
        ]);
    }
}
