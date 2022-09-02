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

use App\Http\Controllers\FlowController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ApiLogController;
use App\Http\Controllers\FlowNodeController;
use App\Http\Controllers\InvokeController;
use App\Http\Controllers\InvokeInputController;
use App\Http\Controllers\InvokeOutputController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\ConnectorController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MockController;

Route::view('/', 'welcome');

Route::resource('flows', FlowController::class);
Route::resource('sessions', SessionController::class);
Route::resource('logs', ApiLogController::class);
Route::resource('flows.nodes', FlowNodeController::class)->shallow();
Route::resource('flows.invokes', InvokeController::class)->shallow();
Route::resource('flows.invokeInputs', InvokeInputController::class)->shallow();
Route::resource('flows.invokeOutputs', InvokeOutputController::class)->shallow();
Route::resource('flows.decisions', DecisionController::class)->shallow();
Route::resource('flows.connectors', ConnectorController::class)->shallow();

Route::post('execute/{flowName}', [MainController::class, 'execute']);
Route::any('mock/{apiName}', [MockController::class, 'execute']);
