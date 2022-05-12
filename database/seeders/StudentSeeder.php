<?php

namespace Database\Seeders;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Database\Factories\ScoreFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory()
            ->count(15)
            ->hasAttached(Subject::factory(5), ['score' => 5])
            ->create();
    }
}
