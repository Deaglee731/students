<?php

namespace App\Policies;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Student;
use App\Models\Dictionaries\RoleDictionary;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        return Response::allow();
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
        if (
            $otherStudent->trashed()
            && $student->role !== RoleDictionary::ROLE_ADMIN
        ) {
            return Response::deny('Вы не можете просматривать этого пользователя! Поскольку он удален');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Student $student)
    {
        if (
            $student->role === RoleDictionary::ROLE_ADMIN
            || $student->role === RoleDictionary::ROLE_TEACHER
        ) {
            return Response::allow();
        }

        return Response::deny('Вы не можете создавать пользователей!');
    }

    public function store(Student $student, RegisterStudentRequest $request)
    {
        if (
            $student->role === RoleDictionary::ROLE_ADMIN
            && $request->role_id !== RoleDictionary::ROLE_ADMIN
        ) {
            return Response::allow();
        }

        if (
            $student->role !== RoleDictionary::ROLE_ADMIN
            && $request->role_id !== RoleDictionary::ROLE_STUDENT
        ) {
            return Response::deny('Вам нельзя создавать данный тип пользователей !');
        }

        if (
            $student->role === RoleDictionary::ROLE_TEACHER &&
            $request->group_id === $student->group_id
        ) {
            return Response::allow();
        }

        return Response::deny('Нет доступа');
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
        if (
            $student->role === RoleDictionary::ROLE_ADMIN
            && $request->role_id === RoleDictionary::ROLE_ADMIN
        ) {
            return Response::deny('Вы не можете выдавать такие привилегии! !');
        }

        if (
            $student->role === RoleDictionary::ROLE_TEACHER
            && $request->role_id !== RoleDictionary::ROLE_STUDENT
        ) {
            return Response::deny('Вы не можете выдавать такие привилегии!');
        }

        if (
            $student->role === RoleDictionary::ROLE_STUDENT
            && $request->role_id !== $student->role
        ) {
            return Response::deny('Вы не можете поменять свою роль!');
        }

        if ($student === $otherStudent) {
            return Response::deny('Вы не можете менять себе роль');
        }

        return Response::allow();
    }

    public function edit(Student $student, Student $otherStudent)
    {
        if (
            $student->role === RoleDictionary::ROLE_ADMIN
            || ($student->role === RoleDictionary::ROLE_TEACHER
                && $student->group_id === $otherStudent->group_id)
            || $otherStudent->id === $student->id
        ) {
            return Response::allow();
        }

        return Response::deny('Вы не можете редактировать !');
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
        if (
            $student->role === RoleDictionary::ROLE_ADMIN
            && $otherStudent->group_id === $student->group_id
            && $otherStudent->role !== RoleDictionary::ROLE_ADMIN
            || $student->role === RoleDictionary::ROLE_TEACHER
            && $otherStudent->group_id === $student->group_id
            && $otherStudent->role === RoleDictionary::ROLE_STUDENT
        ) {
            return Response::allow();
        }

        return Response::deny('У вас нет прав удалять студентов !');
    }

    public function restore(Student $student)
    {
        if ($student->role === RoleDictionary::ROLE_ADMIN) {
            return Response::allow();
        }

        return Response::deny('У вас недостаточно прав');
    }

    public function forceDelete(Student $student, Student $otherStudent)
    {
        if (
            $student->role === RoleDictionary::ROLE_ADMIN
            && $otherStudent->role !== RoleDictionary::ROLE_ADMIN
        ) {
            return Response::allow();
        }

        return Response::deny('У вас недстаточно прав');
    }
}
