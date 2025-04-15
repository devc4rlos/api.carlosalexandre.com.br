<?php

namespace Tests\Feature\V1\Contact;

use App\Models\GeneralInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        GeneralInfo::factory()->create();
    }

    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/v1/contacts');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data',
            'error',
            'code',
        ]);
    }
}
