<?php

namespace App\Policies;

use App\Models\Dictionaries\RoleDictionary;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Student  $student
     *
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
     * @param  \App\Models\Group  $group
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Student $student, Group $group)
    {
        if (
            $student->role === RoleDictionary::ROLE_ADMIN
            || $student->role === RoleDictionary::ROLE_TEACHER
            || $student->group_id === $group->id
        ) {
            return Response::allow();
        }

        return Response::deny('У вас нет прав для просмотра.');
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
        if ($student->role === RoleDictionary::ROLE_ADMIN) {
            return Response::allow();
        }

        return Response::deny('У вас недостаточно прав!');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Group  $group
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Student $student, Group $group)
    {
        if (
            $student->role === RoleDictionary::ROLE_ADMIN
            && $student->group_id === $group->id
        ) {
            return Response::allow();
        }

        return Response::deny('Вы не можете редактировать группу!');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Group  $group
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete()
    {
        return Response::deny('У вас нет возможности удалять группы!');
    }
}
