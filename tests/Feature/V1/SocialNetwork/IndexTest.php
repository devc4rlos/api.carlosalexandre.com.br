<?php

namespace Tests\Feature\V1\SocialNetwork;

use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create());
    }

    public function test_index_returns_all_social_networks_successfully()
    {
        $route = "/v1/social-network";

        SocialNetwork::factory()->count(5)->create();

        $response = $this->get($route);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [],
            'error' => null
        ]);
        $response->assertJsonCount(5, 'data');
        $this->assertDatabaseCount('social_networks', 5);
    }
}
