<?php

namespace Tests\Unit\Journal;

use App\Models\Student;
use App\Services\JournalServices;
use Tests\TestCase;

class StudentListJournalTest extends TestCase
{
    public function test_best_students()
    {
        $journalServiceMock = $this->mock(JournalServices::class);
        $journalServiceMock->shouldReceive('getBestStudents')->with(Student::factory(10)->create());
    }

    public function test_good_students()
    {
        $journalServiceMock = $this->mock(JournalServices::class);
        $journalServiceMock->shouldReceive('getGoodStudents')->with(Student::factory(10)->create());
    }
}
