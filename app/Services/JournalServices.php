<?php

namespace App\Services;

use App\Models\Student;

use function GuzzleHttp\Promise\each;
use function PHPUnit\Framework\isEmpty;

class JournalServices
{
    public static function getBestStudents($students)
    {
        $bestStudents = $students->filter(function ($student) {

            return $student->subjects->min('pivot.score') == 5;
        });
        
        return $bestStudents;
    }
    public static function getGoodStudents($students)
    {
        $goodStudents = $students->filter(function ($student, $key) {

            return $student->subjects->min('pivot.score') == 4;
        });

        return $goodStudents;
    }

    public static function getOtherStudents($students)
    {
        $otherStudents = $students->filter(function ($student, $key) {

            return $student->subjects->min('pivot.score') <= 3;
        });

        return $otherStudents;
    }

    public static function getScoresWithSubjects($subjects, $students)
    {
        $students_subjects = $students->map(function ($student) use ($subjects) {
            $student->subjectsScore = $subjects->merge($student->subjects);

            return $student;
        });

        return $students_subjects;
    }


    public static function getAverageScoreWithSubjects($students)
    {
        $average_scores = collect();

        $subjects_scores = $students->each(function ($student) use (&$average_scores) {
            $student->subjects->each(function ($subject) use (&$average_scores) {
                $average_scores[$subject->id] = array_merge($average_scores[$subject->id] ?? [], [$subject->pivot->score ?? null]);
            });
        });

        $average_scores = $average_scores->map(function ($subject) {
            return array_sum($subject) / count($subject);
        });
       
        return $average_scores;
    }
}
