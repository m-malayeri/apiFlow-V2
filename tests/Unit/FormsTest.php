<?php

namespace Tests\Unit;

use Tests\TestCase;

class FormsTest extends TestCase
{
    public function test_flow_store()
    {
        $response = $this->postJson(
            route('flows.store', 1),
            ['flow_name' => '', 'log_level' => 'All']
        );

        $response->assertInvalid(['flow_name']);
    }

    public function test_node_store_name_empty()
    {
        $response = $this->postJson(
            route('flows.nodes.store', 1),
            ['node_name' => '', 'node_type' => 'Start']
        );

        $response->assertInvalid(['node_name']);
    }

    public function test_node_store_type_empty()
    {
        $response = $this->postJson(
            route('flows.nodes.store', 1),
            ['node_name' => 'Test', 'node_type' => '']
        );

        $response->assertInvalid(['node_type']);
    }
}
