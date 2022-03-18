<?php

namespace App\Policies;

use App\Models\Dictionaries\RoleDictionary;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function before(Student $student)
    {
        if ($student->role == RoleDictionary::ROLE_ADMIN) {
            return true;
        }
    }

    public function viewAny(Student $student)
    {
        return $student->role == RoleDictionary::ROLE_TEACHER ||
            $student->role == RoleDictionary::ROLE_STUDENT;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Student $student, Subject $subject)
    {
        return $student->role == RoleDictionary::ROLE_TEACHER || $student->role == RoleDictionary::ROLE_STUDENT;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Student $student)
    {
        return $student->role == RoleDictionary::ROLE_TEACHER;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Student $student, Subject $subject)
    {
        return $student->role == RoleDictionary::ROLE_TEACHER;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Student $student, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Student $student, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Student $student, Subject $subject)
    {
        //
    }
}
