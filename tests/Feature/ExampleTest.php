<?php

declare(strict_types=1);

namespace Tests\Feature;

 use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
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
        $response = $this->post('api/v1/user/register', $fixture, ['Accept' => 'application/json']);

        $response->assertStatus(201);
    }
}
