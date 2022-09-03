<?php

namespace Tests\Unit;

use Tests\TestCase;

class FormsTest extends TestCase
{
    public function test_flow_store()
    {
        $response = $this->postJson(
            '/flows',
            ['flow_name' => '', 'log_level' => 'All']
        );

        $response->assertInvalid(['flow_name']);
    }
}
