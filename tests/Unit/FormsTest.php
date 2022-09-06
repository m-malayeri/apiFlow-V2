<?php

namespace Tests\Unit;

use Tests\TestCase;

class FormsTest extends TestCase
{
    public function test_flow_store_name_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.store', 1),
            ['flow_name' => '', 'log_level' => 'All']
        );

        $response->assertInvalid(['flow_name']);
    }

    public function test_flow_store_log_level_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.store', 1),
            ['flow_name' => 'Test', 'log_level' => '']
        );

        $response->assertInvalid(['log_level']);
    }

    public function test_flow_store_name_duplicate_returns_error()
    {
        $response = $this->postJson(
            route('flows.store', 1),
            ['flow_name' => 'AutoRegister', 'log_level' => 'All']
        );

        $response->assertInvalid(['flow_name']);
    }

    public function test_node_store_name_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.nodes.store', 1),
            ['node_name' => '', 'node_type' => 'Start']
        );

        $response->assertInvalid(['node_name']);
    }

    public function test_node_store_type_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.nodes.store', 1),
            ['node_name' => 'Test', 'node_type' => '']
        );

        $response->assertInvalid(['node_type']);
    }

    public function test_invoke_store_nodeId_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.invokes.store', 1),
            ['flow_node_id' => '', 'url' => 'https://Test.com', 'method' => 'POST', 'content_type' => 'application/json', 'auth_type' => 'Basic']
        );

        $response->assertInvalid(['flow_node_id']);
    }

    public function test_invoke_store_url_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.invokes.store', 1),
            ['flow_node_id' => '1', 'url' => '', 'method' => 'POST', 'content_type' => 'application/json', 'auth_type' => 'Basic']
        );

        $response->assertInvalid(['url']);
    }

    public function test_invoke_store_method_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.invokes.store', 1),
            ['flow_node_id' => '1', 'url' => 'https://Test.com', 'method' => '', 'content_type' => 'application/json', 'auth_type' => 'Basic']
        );

        $response->assertInvalid(['method']);
    }

    public function test_invoke_store_content_type_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.invokes.store', 1),
            ['flow_node_id' => '1', 'url' => 'https://Test.com', 'method' => 'POST', 'content_type' => '', 'auth_type' => 'Basic']
        );

        $response->assertInvalid(['content_type']);
    }

    public function test_invoke_store_auth_type_empty_returns_error()
    {
        $response = $this->postJson(
            route('flows.invokes.store', 1),
            ['flow_node_id' => '1', 'url' => 'https://Test.com', 'method' => 'POST', 'content_type' => 'application/json', 'auth_type' => '']
        );

        $response->assertInvalid(['auth_type']);
    }
}
