<?php

namespace Tests\Feature\User;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_user()
    {
        $group = Group::factory()->create();

        $admin = Student::factory()->create(['role_id' => 1, 'group_id' => $group->id]);
        $student = Student::factory()->create(['role_id' => 3, 'group_id' => $group->id]);

        $response = $this->actingAs($admin)->delete(route('students.destroy', $student->id));

        $response->assertStatus(302);

        $this->assertSoftDeleted('students', $student->only('id','email'));
    }
}
