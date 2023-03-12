<?php

declare(strict_types=1);

namespace Tests\Feature;

 use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    private const HEADERS = ['Accept' => 'application/json'];

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testSuccessfulUserRegistration()
    {
        $fixture = $this->getFixtureJson('user-register.json');
        $response = $this->post('api/v1/user/register', $fixture[1], self::HEADERS);

        $response->assertStatus(201);
    }

    public function testWrongUserData()
    {
        $fixture = $this->getFixtureJson('user-register.json');
        $response = $this->post('api/v1/user/register', $fixture[2], self::HEADERS);

        $responseErrorMessages = $this->getErrorMessages($response);
        $expectedErrorMessages = [
            'password' => [
                0 => 'The password confirmation does not match.',
                1 => 'The password must be at least 3 characters.'
            ]
        ];

        $this->assertEquals($responseErrorMessages, $expectedErrorMessages);
    }
}
