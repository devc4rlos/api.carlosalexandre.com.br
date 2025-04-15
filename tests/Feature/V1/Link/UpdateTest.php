<?php

namespace Tests\Feature\V1\Link;

use App\Models\Link;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    private Link $link;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(User::factory()->create());

        $this->link = Link::create([
            'name' => fake()->name,
            'url' => fake()->url,
        ]);
    }

    public function test_updating_all_link_fields_with_valid_data_succeeds()
    {
        $route = '/v1/links/' . $this->link->id;
        $link = [
            'name' => fake()->name,
            'url' => fake()->url,
        ];

        $response = $this->patch($route, $link);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => $link,
            'error' => null,
        ]);
        $this->assertDatabaseHas('links', $link);
    }

    public function test_updating_link_name_only_succeeds()
    {
        $route = '/v1/links/' . $this->link->id;
        $data = ['name' => fake()->name];

        $response = $this->patch($route, $data);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => $data,
            'error' => null,
        ]);
        $this->assertDatabaseHas('links', $data);
    }

    public function test_updating_link_with_invalid_data_fails()
    {
        $route = '/v1/links/' . $this->link->id;
        $data = [
            'name' => fake()->randomDigit(),
            'url' => fake()->boolean(),
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
        $this->assertDatabaseMissing('links', $data);
    }

    public function test_updating_link_with_duplicate_name_fails()
    {
        $name = fake()->name;
        $route = '/v1/links/' . $this->link->id;

        Link::create([
            'name' => $name,
            'url' => fake()->url,
        ]);

        $data = [
            'name' => $name,
            'url' => fake()->url,
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
