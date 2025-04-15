<?php

namespace Tests\Feature\V1\SocialNetwork;

use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create());
    }

    public function test_storing_social_network_with_valid_data_succeeds()
    {
        $route = 'v1/social-network';
        $socialNetwork = [
            'name' => fake()->name,
            'url' => fake()->url,
            'icon' => fake()->url,
            'text' => fake()->text(20),
        ];

        $response = $this->post($route, $socialNetwork);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => $socialNetwork,
            'error' => null,
        ]);
        $this->assertDatabaseHas('social_networks', $socialNetwork);
    }

    public function test_storing_social_network_with_invalid_data_fails()
    {
        $route = 'v1/social-network';
        $data = [
            'name' => null,
            'url' => null,
            'icon' => null,
            'text' => null,
        ];

        $response = $this->post($route, $data);
        $response->assertUnprocessable();
        $response->assertJson([
            'data' => null,
            'error' => [
                'name' => [],
                'url' => [],
            ],
        ]);
        $this->assertDatabaseMissing('social_networks', $data);
    }

    public function test_storing_social_network_with_duplicate_name_fails()
    {
        $name = fake()->name;
        $route = 'v1/social-network';

        SocialNetwork::create([
            'name' => $name,
            'url' => fake()->url,
            'icon' => fake()->url,
            'text' => fake()->text(20),
        ]);

        $socialNetwork = [
            'name' => $name,
            'url' => fake()->url,
        ];

        $response = $this->post($route, $socialNetwork);
        $response->assertUnprocessable();
        $response->assertJson([
            'data' => null,
            'error' => [
                'name' => [],
            ],
        ]);
        $this->assertDatabaseMissing('social_networks', $socialNetwork);
    }
}
