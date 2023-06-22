<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\ToolMaterialController;
use App\Http\Controllers\api\ToolProductController;
use App\Http\Controllers\api\ToolItemController;
use App\Http\Controllers\api\UserController;
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
    Route::apiResource('/tool-products/{tool_product}/tool-items', ToolItemController::class);

    Route::get('/project', [ProjectController::class, 'index']);
    Route::post('/project', [ProjectController::class, 'store']);
    Route::post('/project/ongoing', [ProjectController::class, 'ongoing']);
    Route::post('/project/tool/history', [ProjectController::class, 'history']);
    
    Route::apiResource('/users', UserController::class);
});
