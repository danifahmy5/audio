<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->get('/')
            ->assertViewIs('auth.login');
    }

    public function testLoginFailed()
    {
        $this->post('login', [
            'username' => 'ros',
            'password' => '',
        ])->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('login', [
            'username' => 'ros',
            'password' => '123123',
        ])->assertRedirect('/schadules')
            ->assertSessionHas('auth');
    }

    public function testViewLoginPageAfterLogin()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user)
            ->get('/login')
            ->assertRedirect('/schadules');
    }
}
