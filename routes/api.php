<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ToolMaterialController;
use App\Http\Controllers\api\ToolProductController;
use App\Http\Controllers\api\ToolItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Add AuthController routes
Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::apiResource('/tool-materials', ToolMaterialController::class);
    Route::apiResource('/tool-products', ToolProductController::class);
    Route::apiResource('/tool-products/{toolProduct}/tool-items', ToolItemController::class);
});
