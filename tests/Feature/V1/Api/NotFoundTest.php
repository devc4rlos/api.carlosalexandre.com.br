<?php

namespace Tests\Feature\V1\Api;


use Tests\TestCase;

class NotFoundTest extends TestCase
{
    public function test_the_application_returns_a_redirect_not_found_response()
    {
        $route = "/v1/not-found";

        $response = $this->get($route);

        $response->assertNotFound();
    }
}
