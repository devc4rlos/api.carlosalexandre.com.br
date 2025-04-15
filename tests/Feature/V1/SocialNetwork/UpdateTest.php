<?php

namespace Tests\Feature\V1\SocialNetwork;

use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    private SocialNetwork $socialNetwork;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(User::factory()->create());

        $this->socialNetwork = SocialNetwork::create([
            'name' => fake()->name,
            'url' => fake()->url,
            'icon' => fake()->url,
            'text' => fake()->text(20),
        ]);
    }

    public function test_updating_all_social_network_fields_with_valid_data_succeeds()
    {
        $route = '/v1/social-network/' . $this->socialNetwork->id;
        $socialNetwork = [
            'name' => fake()->name,
            'url' => fake()->url,
            'icon' => fake()->url,
            'text' => fake()->text(20),
        ];

        $response = $this->patch($route, $socialNetwork);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => $socialNetwork,
            'error' => null,
        ]);
        $this->assertDatabaseHas('social_networks', $socialNetwork);
    }

    public function test_updating_social_network_name_only_succeeds()
    {
        $route = '/v1/social-network/' . $this->socialNetwork->id;
        $data = ['name' => fake()->name];

        $response = $this->patch($route, $data);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => $data,
            'error' => null,
        ]);
        $this->assertDatabaseHas('social_networks', $data);
    }

    public function test_updating_social_network_with_invalid_data_fails()
    {
        $route = '/v1/social-network/' . $this->socialNetwork->id;
        $data = [
            'name' => fake()->randomDigit(),
            'url' => fake()->boolean(),
            'icon' => fake()->boolean(),
            'text' => fake()->randomDigit(),
        ];

        $response = $this->patch($route, $data);
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

    public function test_updating_social_network_with_duplicate_name_fails()
    {
        $name = fake()->name;
        $route = '/v1/social-network/' . $this->socialNetwork->id;

        SocialNetwork::create([
            'name' => $name,
            'url' => fake()->url,
            'icon' => fake()->url,
            'text' => fake()->text(20),
        ]);

        $data = [
            'name' => $name,
            'url' => fake()->url,
            'icon' => fake()->url,
            'text' => fake()->text(20),
        ];

        $response = $this->patch($route, $data);
        $response->assertUnprocessable();
        $response->assertJson([
            'data' => null,
            'error' => [
                'name' => [],
            ],
        ]);
    }
}
