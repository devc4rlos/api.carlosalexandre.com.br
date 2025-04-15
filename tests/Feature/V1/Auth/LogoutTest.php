<?php

namespace Tests\Feature\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_logout_revokes_authentication_token()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $routeLogout = "/v1/logout";

        $response = $this->post($routeLogout, headers: [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertSuccessful();
        $this->assertCount(0, $user->tokens);
    }
}
