<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerCampaignController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\Cors;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::group(['prefix' => "campaign"], function () {
        Route::get('/', [CampaignController::class, 'show']);
        Route::post('/', [CampaignController::class, 'store']);
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::post('/', [OrderController::class, 'store']);
    });
});
