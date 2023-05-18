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
        $user = Student::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get(route('groups.create'));

        $response->assertOk()->assertViewIs('groups.create');
    }
}
