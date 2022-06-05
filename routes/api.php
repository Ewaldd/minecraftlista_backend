<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\VoteController;
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

Route::get('servers', [ServerController::class, 'index']);
Route::post('servers', [ServerController::class, 'store']);
Route::get('servers/{id}', [ServerController::class, 'show']);

Route::get('categories', [CategoryController::class, 'index']);
Route::post('categories', [CategoryController::class, 'store']);
Route::get('categories/{id}', [CategoryController::class, 'show']);

Route::post('votes', [VoteController::class, 'store']);

