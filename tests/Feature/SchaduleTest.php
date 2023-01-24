<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SchaduleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSchaduleL()
    {
        $user = User::factory()->make();
        var_dump($user);
        die;
        // $this->actingAs($user)->get('schadules')->assertStatus(200);
    }
}
