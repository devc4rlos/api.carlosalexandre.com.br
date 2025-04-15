<?php

namespace Tests\Feature\V1\Auth;

use App\Models\GeneralInfo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private string $userPassword;

    protected function setUp(): void
    {
        parent::setUp();

        GeneralInfo::factory()->create();
        $this->userPassword = 'password';
        $this->user = User::factory()->create([
            'password' => $this->userPassword
        ]);
    }

    public function test_valid_login_returns_correct_response_structure()
    {
        $route = "/v1/login";

        $response = $this->post($route, [
            'email' => $this->user->email,
            'password' => $this->userPassword,
        ]);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            "message",
            "data" => [
                "token",
            ],
           "error",
           "code",
        ]);
        $response->assertJson([
            'error' => null,
        ]);
    }

    public function test_invalid_login_returns_error_response_structure()
    {
        $route = "/v1/login";

        $response = $this->post($route, [
            'email' => $this->user->email,
            'password' => 'password-error',
        ]);

        $response->assertUnauthorized();
        $response->assertJsonStructure([
            "message",
            "data",
            "error",
            "code",
        ]);
        $response->assertJson([
            'data' => null,
            'error' => [],
        ]);
    }
}
