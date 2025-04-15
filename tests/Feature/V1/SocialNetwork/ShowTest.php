<?php

namespace Tests\Feature\V1\SocialNetwork;

use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create());
    }

    public function test_show_returns_single_social_network_successfully()
    {
        $socialNetwork = SocialNetwork::factory()->create();
        $route = "/v1/social-network/" . $socialNetwork->id;

        $response = $this->get($route);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [],
            'error' => null
        ]);
        $this->assertDatabaseHas("social_networks", ['id' => $socialNetwork->id]);
    }
}
