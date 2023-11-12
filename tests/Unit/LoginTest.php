<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test a successful login.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {
        $password = $this->faker->password;
        $user = User::create([
            'name' => 'Italo Donoso',
            'email' => 'italo.donoso@ucn.cl',
            'role' => 'admin',
            'password' => 'Turjoy91',
        ]);

        $response = $this->post('/login', [
            'email' => 'italo.donoso@ucn.cl',
            'password' => 'Turjoy91',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test a failed login.
     *
     * @return void
     */
    public function testFailedLogin()
    {
        $response = $this->post('/login', [
            'email' => 'fake@ucn.cl',
            'password' => 'fake123',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
    }
}


