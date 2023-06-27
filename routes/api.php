<?php

use App\Http\Controllers\AuthController as AuthController;
use App\Http\Controllers\Customer\ImageController as ImageController;
use App\Http\Controllers\Customer\CampaignController as CampaignController;
use App\Http\Controllers\Customer\OrderController as OrderController;
use App\Http\Controllers\Customer\UsersController as UsersController;
use App\Http\Middleware\AdminMiddleware as AdminMiddleware;
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
        Route::middleware([AdminMiddleware::class])->get('/', [OrderController::class, 'show']);
        Route::get('/{id}', [OrderController::class, 'getDetail']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UsersController::class, 'index']);
        Route::post('/profile-photo', [UsersController::class, 'updateProfilePhoto']);
    });
});

Route::get('/public/images/{filename}', [ImageController::class, 'getImage']);
