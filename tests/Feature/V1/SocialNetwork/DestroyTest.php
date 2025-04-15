<?php

namespace Tests\Feature\V1\SocialNetwork;

use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(User::factory()->create());
    }

    public function test_destroy_deletes_social_network_successfully()
    {
        $socialNetwork = SocialNetwork::factory()->create();
        $route = 'v1/social-network/' . $socialNetwork->id;

        $response = $this->delete($route);

        $response->assertSuccessful();
        $response->assertJson([
           'data' => [
               'id' => $socialNetwork->id,
           ],
           'error' => null,
        ]);
        $this->assertDatabaseMissing('social_networks', ['id' => $socialNetwork->id]);
    }
}
