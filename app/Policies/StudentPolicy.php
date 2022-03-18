<?php

namespace App\Policies;

use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Dictionaries\RoleDictionary;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Student $student)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Student $student, Student $otherStudent)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Student $student)
    {
        return $student->role == RoleDictionary::ROLE_ADMIN ||
            $student->role == RoleDictionary::ROLE_TEACHER;
    }

    public function store(Student $student, RegisterStudentRequest $request)
    {
        if ($student->role == RoleDictionary::ROLE_ADMIN && ($request->role_id == RoleDictionary::ROLE_TEACHER ||
        $request->role_id == RoleDictionary::ROLE_STUDENT)){
            return true;
        }

        if (($student->role == RoleDictionary::ROLE_TEACHER || $student->role == RoleDictionary::ROLE_STUDENT) &&
            $request->role_id == RoleDictionary::ROLE_ADMIN || $request->role_id == RoleDictionary::ROLE_TEACHER) {
            return false;
        }

        return $student->role == RoleDictionary::ROLE_TEACHER &&
            $request->group_id == $student->group_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Student $student, Student $otherStudent, StudentRequest $request)
    {
        if ($student->role == RoleDictionary::ROLE_ADMIN && $request->role_id == RoleDictionary::ROLE_ADMIN) {
            return false;
        }

        if ($student->role == RoleDictionary::ROLE_TEACHER &&
            ($request->role_id == RoleDictionary::ROLE_ADMIN || $request->role_id == RoleDictionary::ROLE_TEACHER)) {
            return false;
        }
        if ($student->role == RoleDictionary::ROLE_STUDENT && $request->role_id != $student->role){
            return false;
        }

        return true;
    }

    public function edit(Student $student, Student $otherStudent)
    {
        return $student->role == RoleDictionary::ROLE_ADMIN ||
            ($student->role == RoleDictionary::ROLE_TEACHER && $student->group_id == $otherStudent->group_id) ||
            ($otherStudent->id == $student->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Student $student, Student $otherStudent)
    {
        return $student->role == RoleDictionary::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Student $student, Student $otherStudent)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Student $student, Student $otherStudent)
    {
        //
    }
}
