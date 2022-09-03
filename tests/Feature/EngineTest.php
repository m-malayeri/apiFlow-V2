<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EngineTest extends TestCase
{
    /*
    public function test_flow_returns_success()
    {
        $response = $this->postJson('/execute/AutoRegister', ['MembershipNumber' => '500218', 'ProgramId' => '9SIA-GQI6H', 'ProductName' => '284']);
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'ResponseCode' => "0",
                'ResponseDescription' => "Flow execution completed successfully",
            ]);
    }
    */

    public function test_flow_not_exist_returns_error()
    {
        $response = $this->postJson('/execute/notExistWorkflow');
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'ResponseCode' => "-100",
                'ResponseDescription' => "Flow not found, please check flow name",
            ]);
    }

    public function test_flow_not_active_returns_error()
    {
        $response = $this->postJson('/execute/mockAPI');
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'ResponseCode' => "-105",
                'ResponseDescription' => "Flow is disabled, please enable it via GUI",
            ]);
    }

    /*
    public function test_flow_with_wrong_invoke_config_returns_error()
    {
        $response = $this->postJson('/execute/wrongInvokeConfig', ['MembershipNumber' => '500218', 'ProgramId' => '9SIA-GQI6H', 'ProductName' => '284']);
        $response
            ->assertStatus(200)
            ->assertJson([
                'ResponseCode' => "-110",
                'ResponseDescription' => "Flow is disabled, please enable it via GUI",
            ]);
    }

    public function test_flow_with_wrong_decision_config_returns_error()
    {
        $response = $this->postJson('/execute/wrongDecisionConfig', ['MembershipNumber' => '500100']);
        $response
            ->assertStatus(200)
            ->assertJson([
                'ResponseCode' => "-115",
            ]);
    }
    */
}
