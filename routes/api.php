<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\authController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [authController::class, 'login']);

Route::get('/users/{id?}', [authController::class, 'users'])->middleware('auth:sanctum');
Route::post('/store-user/{id?}', [authController::class, 'storeUser'])->middleware('auth:sanctum');
Route::delete('/users/destroy/{id}', [authController::class, 'destroy'])->middleware('auth:sanctum');

