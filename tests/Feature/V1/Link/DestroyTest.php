<?php

namespace Tests\Feature\V1\Link;

use App\Models\Link;
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

    public function test_destroy_deletes_link_successfully()
    {
        $link = Link::factory()->create();
        $route = 'v1/links/' . $link->id;

        $response = $this->delete($route);

        $response->assertSuccessful();
        $response->assertJson([
           'data' => [
               'id' => $link->id,
           ],
           'error' => null,
        ]);
        $this->assertDatabaseMissing('links', ['id' => $link->id]);
    }
}
