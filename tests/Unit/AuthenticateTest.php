<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthenticateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public static $API_PATH = '/api/v1';

    public function test_user_can_register()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'wK.<(313%w83',
            'password_confirmation' => 'wK.<(313%w83',
        ];

        $response = $this->postJson(self::$API_PATH . '/register', $userData);
        $response->assertStatus(200);
    }


    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $loginData = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->postJson(self::$API_PATH . '/login', $loginData);
        $response->assertStatus(200);
    }


    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(self::$API_PATH . '/logout');
        $response->assertStatus(200);
    }
}
