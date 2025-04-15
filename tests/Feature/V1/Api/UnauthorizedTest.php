<?php

namespace Tests\Feature\V1\Api;


use Tests\TestCase;

class UnauthorizedTest extends TestCase
{
    public function test_the_application_returns_a_unauthorized_response()
    {
        $route = "/v1/links";

        $response = $this->get($route);

        $response->assertUnauthorized();
    }
}
