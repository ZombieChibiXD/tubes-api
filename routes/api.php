<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\ToolColorCodeController;
use App\Http\Controllers\api\ToolMaterialController;
use App\Http\Controllers\api\ToolProductController;
use App\Http\Controllers\api\UserController;
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
    
    Route::apiResource('/users', UserController::class);
    
    Route::get('/tool/history/{tool}', [ProjectController::class, 'history']);
    Route::get('/project/form', [ProjectController::class, 'form']);
    Route::apiResource('/project', ProjectController::class);
    Route::apiResource('/tool/materials', ToolMaterialController::class);
    Route::apiResource('/tool/products', ToolProductController::class);
    Route::apiResource('/tool/color-codes', ToolColorCodeController::class);
    
});
