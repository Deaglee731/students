<?php

namespace Tests\Feature\User;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_new_user()
    {
        $user = Student::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($user)->get(route('students.create'));

        $response->assertOk()->assertViewIs('students.create');
    }
}
