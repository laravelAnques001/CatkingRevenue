<?php

use App\Http\Controllers\API\NPFWebHookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/npf-webhook', function (Request $request) {
//     Log::info("npf-webhook");
//     Log::info($request->all());
//     echo json_encode($request->all());
//     exit;
// });
Route::post('/npf-webhook', [NPFWebHookController::class, 'store']);

Route::post('/ozontel-webhook', function (Request $request) {
    Log::info("ozontel-webhook");
    Log::info($request->all());
    echo json_encode($request->all());
    exit;
});
