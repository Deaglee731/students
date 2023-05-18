<?php

namespace Tests\Feature\User;

use App\Models\Dictionaries\RoleDictionary;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_new_student()
    {
        $student = Student::factory()->make();
        $admin = Student::factory()->create(['role_id' => 1]);

        $response = $this->actingAs($admin)->post(route('students.store'), $student->all()->except(['id'])->toArray());
        $this->assertDatabaseHas('students', [$student->all()->toArray()]);

        $response->assertStatus(302)->assertRedirect();
    }
}
