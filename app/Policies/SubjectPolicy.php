<?php

namespace App\Policies;

use App\Models\Dictionaries\RoleDictionary;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Student  $student
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function before(Student $student)
    {
        return $student->role === RoleDictionary::ROLE_ADMIN
            ? Response::allow()
            : Response::deny('У вас недостаточно прав');
    }

    public function viewAny(Student $student)
    {
        return $student->role === RoleDictionary::ROLE_TEACHER ||
            $student->role === RoleDictionary::ROLE_STUDENT
            ? Response::allow()
            : Response::deny('У вас недостаточно прав');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Subject  $subject
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Student $student)
    {
        return $student->role === RoleDictionary::ROLE_TEACHER ||
            $student->role === RoleDictionary::ROLE_STUDENT
            ? Response::allow()
            : Response::deny('У вас недостаточно прав');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Student  $student
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Student $student)
    {
        return $student->role === RoleDictionary::ROLE_TEACHER
            ? Response::allow()
            : Response::deny('У вас недостаточно прав');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Subject  $subject
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Student $student)
    {
        return $student->role === RoleDictionary::ROLE_TEACHER
            ? Response::allow()
            : Response::deny('У вас недостаточно прав');
    }
}
