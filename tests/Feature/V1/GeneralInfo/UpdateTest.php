<?php

namespace Tests\Feature\V1\GeneralInfo;

use App\Models\GeneralInfo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        GeneralInfo::factory()->create();
        Sanctum::actingAs(User::factory()->create());
    }

    public function test_updating_all_general_info_fields_with_valid_data_succeeds()
    {
        $data = GeneralInfo::factory()->make()->toArray();

        $route = 'v1/info';
        $response = $this->patch($route, $data);

        $response->assertSuccessful();
        $response->assertJson([
            'data' => $data,
            'error' => null,
        ]);
    }

    public function test_updating_name_and_email_only_succeeds()
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->unique()->email,
        ];

        $route = 'v1/info';
        $response = $this->patch($route, $data);

        $response->assertSuccessful();
        $response->assertJson([
            'data' => $data,
            'error' => null,
        ]);
    }

    public function test_updating_general_info_with_invalid_data_fails()
    {
        $data = [
            'email' => fake()->name,
            'phone' => fake()->text(5),
        ];

        $route = 'v1/info';
        $response = $this->patch($route, $data);

        $response->assertUnprocessable();
        $response->assertJson([
            'data' => null,
            'error' => [
                'email' => [],
                'phone' => [],
            ],
        ]);
    }

    public function test_updating_email_with_unique_value_succeeds()
    {
        $email = GeneralInfo::first()->email;
        $name = fake()->name;

        $data = [
            'email' => $email,
            'name' => $name,
        ];

        $route = 'v1/info';
        $response = $this->patch($route, $data);

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'email' => $email,
                'name' => $name,
            ],
            'error' => null,
        ]);
    }
}
