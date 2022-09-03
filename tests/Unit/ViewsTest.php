<?php

namespace Tests\Unit;

use Tests\TestCase;

class ViewsTest extends TestCase
{
    // $view = $this->get('/flows', ['name' => 'Taylor']);


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_flows_view()
    {
        $view = $this->get('flows');
        $view->assertSee('New Flow');
    }

    public function test_nodes_view()
    {
        $view = $this->get('flows/1/nodes');
        $view->assertSee('New Node');
    }

    public function test_invokes_view()
    {
        $view = $this->get('flows/1/invokes');
        $view->assertSee('New Invoke');
    }

    public function test_invoke_inputs_view()
    {
        $view = $this->get('flows/1/invokeInputs');
        $view->assertSee('New Invoke Input');
    }

    public function test_invoke_outputs_view()
    {
        $view = $this->get('flows/1/invokeOutputs');
        $view->assertSee('New Invoke Output');
    }

    public function test_decision_view()
    {
        $view = $this->get('flows/1/decisions');
        $view->assertSee('New Decision');
    }

    public function test_connector_view()
    {
        $view = $this->get('flows/1/connectors');
        $view->assertSee('New Connector');
    }

    public function test_sessions_view()
    {
        $view = $this->get('sessions');
        $view->assertSee('Source IP');
    }

    public function test_logs_view()
    {
        $view = $this->get('logs');
        $view->assertSee('Request Timestamp');
    }
}
