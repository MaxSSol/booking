<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    public function test_registration_with_wrong_credentials()
    {
        $response = $this->post(
            '/api/registration',
            [
                'email' => 'test@email.com',
                'first_name' => '',
                'password' => 'Pa$$w0rd!',
                'password_confirmation' => 'Pa$$w0rd'
            ]
        );

        $response->assertStatus(302);
    }

    public function test_registration_with_true_credentials()
    {
        $response = $this->post(
            '/api/registration',
            [
                'email' => 'test@email.com',
                'first_name' => 'test',
                'password' => 'Pa$$w0rd!',
                'password_confirmation' => 'Pa$$w0rd!'
            ]
        );

        $response->assertStatus(200);

        $response->assertJsonPath('user.first_name', 'test');
    }
}
