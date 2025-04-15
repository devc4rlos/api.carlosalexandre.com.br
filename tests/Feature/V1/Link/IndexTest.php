<?php

namespace Tests\Feature\V1\Link;

use App\Models\Link;
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

    public function test_index_returns_all_links_successfully()
    {
        $route = "/v1/links";

        Link::factory()->count(5)->create();

        $response = $this->get($route);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [],
            'error' => null
        ]);
        $response->assertJsonCount(5, 'data');
        $this->assertDatabaseCount('links', 5);
    }
}
