<?php

namespace App\Listeners;

use App\Events\CreatedStudent;
use App\Models\Subject;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateRandomScore
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        foreach($subjects as $subject){
            $student->subjects()->attach($subject->id, [
                'score' => rand(1, 5)
            ]);
        }
    }
}
