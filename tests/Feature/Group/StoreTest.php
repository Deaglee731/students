<?php

namespace Tests\Feature\Group;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    public function test_store_new_group()
    {
        $group = Group::factory()->make();
        $admin = Student::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($admin)->post(route('groups.store'), $group->only('name'));
        $this->assertDatabaseHas('groups', $group->only('name'));

        $response->assertStatus(302)->assertRedirect();
    }
}
