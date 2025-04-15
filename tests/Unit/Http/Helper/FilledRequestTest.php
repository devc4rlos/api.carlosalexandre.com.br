<?php

namespace Tests\Unit\Http\Helper;

use App\Http\Helper\FilledRequest;
use Tests\TestCase;

class FilledRequestTest extends TestCase
{
    public function test_filter_removes_null_and_empty_string_values()
    {
        $input = [
            'name' => 'John Doe',
            'email' => '',
            'age' => null,
            'active' => false,
            'count' => 0,
            'notes' => ' ',
        ];

        $expected = [
            'name' => 'John Doe',
            'active' => false,
            'count' => 0,
            'notes' => ' ',
        ];

        $result = FilledRequest::filter($input);

        $this->assertSame($expected, $result);
    }

    public function test_filter_returns_empty_array_if_all_values_are_empty_or_null()
    {
        $input = [
            'a' => null,
            'b' => '',
            'c' => '',
            'd' => null,
        ];

        $result = FilledRequest::filter($input);

        $this->assertSame([], $result);
    }

    public function test_filter_keeps_non_empty_values()
    {
        $input = [
            'name' => 'Alice',
            'status' => '0',
            'score' => 100,
        ];

        $expected = $input;

        $result = FilledRequest::filter($input);

        $this->assertSame($expected, $result);
    }
}
