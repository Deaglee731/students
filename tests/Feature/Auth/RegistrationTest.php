<?php

namespace Tests\Feature\Auth;

use App\Models\Dictionaries\RoleDictionary;
use App\Models\Group;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'first_name' => 'Test User',
            'last_name' => 'Test lastname',
            'middle_name' => 'TEst MiddleName',
            'group_id' => Group::factory()->create()->id,
            'city' => 'Example',
            'street' => 'EXample',
            'home' => 'eXample',
            'birthday' => '2012-10-10',
            'role_id' => RoleDictionary::ROLE_ADMIN,
            'email' => 'test2@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
