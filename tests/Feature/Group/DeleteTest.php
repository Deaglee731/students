<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use App\Models\Student;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    public function test_delete_group()
    {
        $group = Group::factory()->create();

        $admin = Student::factory()->create(['role_id' => 1, 'group_id' => $group->id]);

        $response = $this->actingAs($admin)->delete(route('groups.destroy', $group->id));

        $response->assertStatus(403);
    }
}
