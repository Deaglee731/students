<?php

namespace App\Services;

class JournalServices
{
    public function getBestStudents($students)
    {
        $students->filter(function ($student) {
            return $student->subjects->min('pivot.score') === '5';
        });

        return $students;
    }
    public function getGoodStudents($students)
    {
        $students->filter(function ($student) {
            return $student->subjects->min('pivot.score') === '4';
        });

        return $students;
    }

    public function getOtherStudents($students)
    {
        $students->filter(function ($student) {
            return $student->subjects->min('pivot.score') <= 3;
        });

        return $students;
    }

    public function getScoresWithSubjects($subjects, $students)
    {
        $students->map(function ($student) use ($subjects) {
            return $student->subjectsScore = $subjects->merge($student->subjects);
        });

        return $students;
    }

    public function getAverageScoreWithSubjects($students)
    {
        $average_scores = collect();

        $students->each(function ($student) use (&$average_scores) {
            $student->subjects->each(function ($subject) use (&$average_scores) {
                $average_scores[$subject->id] = array_merge($average_scores[$subject->id] ?? [], [$subject->pivot->score ?? null]);
            });
        });

        $average_scores->map(function ($subject) {
            return array_sum($subject) / count($subject);
        });

        return $average_scores;
    }
}
