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
Route::post('/forgot-password', [authController::class, 'forgotPassword'])->name('forgot.password')->middleware('guest');
Route::post('/change-password/{token}', [authController::class, 'changePassword'])->name('change.password')->middleware('guest');

Route::get('/get-states', [authController::class, 'getStates'])->middleware('auth:sanctum');

Route::get('/users/{id?}', [authController::class, 'users'])->middleware('auth:sanctum');
Route::post('/store-user/{id?}', [authController::class, 'storeUser'])->middleware('auth:sanctum');
Route::delete('/users/destroy/{id}', [authController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/books/{id?}', [authController::class, 'books'])->middleware('auth:sanctum');
Route::post('/store-book', [authController::class, 'storeBook'])->middleware('auth:sanctum');
Route::post('/update-book/{id}', [authController::class, 'updateBook'])->middleware('auth:sanctum');
Route::delete('/books/destroy/{id}', [authController::class, 'destroyBook'])->middleware('auth:sanctum');

Route::get('/logout', [authController::class, 'logout'])->middleware('auth:sanctum');

