<?php

namespace Tests\Feature\Group;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_new_group()
    {
        $admin = Student::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($admin)->get(route('groups.create'));

        $response->assertOk()->assertViewIs('groups.create');
    }
}
