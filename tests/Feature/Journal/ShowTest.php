<?php

namespace Tests\Feature\Journal;

use App\Models\Group;
use App\Models\Student;
use App\Services\JournalServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery\MockInterface;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_journal()
    {
        $admin = Student::factory()->create(['role_id' => 1]);
        $this->seed();
        $group = Group::first();

        $response = $this->actingAs($admin)->get(route('group_journal.index', $group->id));
        $response->assertViewIs('journal.index')->assertOk();
    }
}
