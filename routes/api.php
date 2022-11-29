<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OwnerController;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
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

// public api
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('mobil', OwnerController::class)->except([
    'create', 'edit', 'store', 'update', 'destroy'
]);
Route::resource('pesan', CustomerController::class)->except([
    'create', 'edit', 'store', 'update', 'destroy'
]);

// protectes api
Route::middleware('auth:sanctum')->group(function(){
    Route::resource('mobil', OwnerController::class)->except('create', 'edit', 'show', 'index');
    Route::resource('pesan', CustomerController::class)->except('create', 'edit', 'show', 'index');
    Route::post('/logout', [AuthController::class, 'logout']);
});