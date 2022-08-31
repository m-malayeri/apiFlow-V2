<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\MainController;
use App\Http\Controllers\FlowController;
use App\Http\Controllers\FlowNodeController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\InvokeController;
use App\Http\Controllers\ConnectorController;

Route::get('/', [MainController::class, 'getHomeData']);
Route::post('execute/{flowName}', [MainController::class, 'execute']);
Route::get('node/{flowId}', [MainController::class, 'getFlowData']);
Route::get('node', [MainController::class, 'redirect']);

Route::post('flow', [FlowController::class, 'store']);
Route::get('flow/show/{flowId}', [FlowController::class, 'show']);
Route::get('flow/disable/{flowId}', [FlowController::class, 'disable']);
Route::get('flow/enable/{flowId}', [FlowController::class, 'enable']);
Route::get('flow/delete/{flowId}', [FlowController::class, 'destroy']);

Route::post('node', [FlowNodeController::class, 'store']);
Route::get('node/delete/{flowId}', [FlowNodeController::class, 'destroy']);

Route::post('node', [InvokeController::class, 'store']);
Route::get('invoke/delete/{invokeId}', [InvokeController::class, 'destroy']);

Route::post('decision', [DecisionController::class, 'store']);
Route::get('decision/delete/{decisionId}', [DecisionController::class, 'destroy']);

Route::post('connector', [ConnectorController::class, 'store']);
Route::get('connector/delete/{connectorId}', [ConnectorController::class, 'destroy']);

Route::any('mock/{apiName}', [MockController::class, 'execute']);
