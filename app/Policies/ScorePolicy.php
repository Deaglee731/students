<?php

namespace App\Policies;

use App\Models\Dictionaries\RoleDictionary;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScorePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manageScore (Student $student , Student $user){
        if (
            $student->role != RoleDictionary::ROLE_STUDENT 
            && ($student->group_id == $user->group_id)
        ) {
            return true;
        }
    }
}
