<?php

namespace Tests\Feature\V1\Home;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_the_application_returns_a_redirect_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
