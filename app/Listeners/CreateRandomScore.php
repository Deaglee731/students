<?php

namespace App\Listeners;

use App\Models\Subject;
use App\Events\CreatedStudent;

class CreateRandomScore
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreatedStudent  $event
     * @return void
     */
    public function handle(CreatedStudent $event)
    {
        $student = $event->student;
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            $student->subjects()->attach($subject->id, [
                'score' => rand(1, 5),
            ]);
        }
    }
}
