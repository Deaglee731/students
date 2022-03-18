<?php

namespace App\Providers;

use App\Models\Dictionaries\RoleDictionary;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Policies\GroupPolicy;
use App\Policies\StudentPolicy;
use App\Policies\SubjectPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Student::class => StudentPolicy::class,
        Subject::class => SubjectPolicy::class,
        Group::class => GroupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-score', function (Student $student , Student $user) {
            if (
                $student->role != RoleDictionary::ROLE_STUDENT 
                && ($student->group_id == $user->group_id)
            ) {
                return true;
            }
        });
    }
}
