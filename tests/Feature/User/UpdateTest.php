<?php

namespace Tests\Feature\User;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
   // use RefreshDatabase;
    public function test_update_students()
    {
        $admin = Student::factory()->create(['role_id' => 1]);
        $student = Student::factory()->create(['role_id' => 3]);
        $updateFields = Student::factory()->makeOne(['role_id' => 3, 'city' => 'Moscow', 'street' => 'Tverskaya', 'home' => 5]);

        $response = $this->actingAs($admin)
            ->patch(route('students.update',
                ['student' => $student->id]), $updateFields->getAttributes());

        $this->assertDatabaseMissing('students', $student->only(['email', 'first_name', 'last_name']));
        $this->assertDatabaseHas('students', $updateFields->only(['email', 'first_name', 'last_name']));

        $response->assertStatus(302)->assertRedirect();
    }

}
