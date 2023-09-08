<?php

namespace Tests\Unit;

use App\Models\User;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'api/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."]
                ]
                ]);
    }

    public function testRepeatPassword()
    {
        $userData = [
            "name" => "nur sidik",
            "email" => "nur@sidik.com",
            "password" => "gilgamesh"
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => "The given data was invalid.",
                "errors" => [
                    "password" => ["The password confirmation does not match."]
                ]
                ]);
    }

    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "nur sidik",
            "email" => "nur@sidik.com",
            "password" => "gilgamesh",
            "password_confirmation" => "gilgamesh"
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                'access_token',
                'message'
            ]);
    }

    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."]
                ]
                ]);
    }

    public function testSuccessfulLogin()
    {
        $user = User::factory()->create([
            'email' => 'sample@test.com',
            'password' => bcrypt('gilgamesh')
        ]);

        $loginData = [
            'email' => 'sample@test.com',
            'password' => 'gilgamesh'
        ];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at'
                ],
                "access_token",
                "message"
            ]);
        $this->assertAuthenticated();
    }
}
