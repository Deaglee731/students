<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    public function test_update_group()
    {
        $group = Group::factory()->create();
        $admin = Student::factory()->create(['role_id' => 1, 'group_id' => $group->id]);

        $groupFields = Group::factory()->makeOne();

        $response = $this->actingAs($admin)
            ->patch(route('groups.update',
                ['group' => $group->id]), $groupFields->getAttributes());

        $this->assertDatabaseMissing('groups', $group->only('name'));
        $this->assertDatabaseHas('groups', $groupFields->only('name'));

        $response->assertStatus(302)->assertRedirect();
    }

    public function test_update_without_permission()
    {
        $group = Group::factory()->create();
        $admin = Student::factory()->create(['role_id' => 1]);

        $groupFields = Group::factory()->makeOne();

        $response = $this->actingAs($admin)
            ->patch(route('groups.update',
                ['group' => $group->id]), $groupFields->getAttributes());

        $response->assertStatus(403);
    }
}
