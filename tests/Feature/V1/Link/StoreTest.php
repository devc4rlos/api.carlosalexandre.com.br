<?php

namespace Tests\Feature\V1\Link;

use App\Models\Link;
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

    public function test_storing_link_with_valid_data_succeeds()
    {
        $route = 'v1/links';
        $link = [
            'name' => fake()->name,
            'url' => fake()->url,
        ];

        $response = $this->post($route, $link);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => $link,
            'error' => null,
        ]);
        $this->assertDatabaseHas('links', $link);
    }

    public function test_storing_link_with_invalid_data_fails()
    {
        $route = 'v1/links';
        $data = [
            'name' => null,
            'url' => null,
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
        $this->assertDatabaseMissing('links', $data);
    }

    public function test_storing_link_with_duplicate_name_fails()
    {
        $name = fake()->name;
        $route = 'v1/links';

        Link::create([
            'name' => $name,
            'url' => fake()->url,
        ]);

        $link = [
            'name' => $name,
            'url' => fake()->url,
        ];

        $response = $this->post($route, $link);
        $response->assertUnprocessable();
        $response->assertJson([
            'data' => null,
            'error' => [
                'name' => [],
            ],
        ]);
        $this->assertDatabaseMissing('links', $link);
    }
}
