<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    public function test_authentication_with_wrong_credentials()
    {
        $response = $this->post('/api/login', ['email' => 'test@email.com', 'password' => 'password']);

        $response->assertStatus(400);

        $response->assertJsonPath('error', 'Перевірте правельність даних.');
    }

    public function test_authentication_with_true_credentials()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', ['email' => $user->email, 'password' => 'password']);

        $response->assertStatus(200);

        $response->assertJsonPath('user.first_name', $user->first_name);
    }
}
