<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\user\authController;
use App\Http\Controllers\user\bookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::match(['get','post'],'/', [bookController::class, 'index'])->name('store.index');

// User Routes
Route::name('user.')->group(function () {
    // User Auth Route
    Route::match(['get','post'],'/register', [authController::class, 'register'])->name('register');
    Route::match(['get','post'],'/login', [authController::class, 'login'])->name('login')->middleware('guest');
    Route::match(['get','post'],'/forgot-password', [authController::class, 'forgotPassword'])->name('forgot.password')->middleware('guest');
    Route::match(['get','post'],'/change-password/{token}', [authController::class, 'changePassword'])->name('change.password')->middleware('guest');
    Route::match(['get','post'],'/edit-profile', [authController::class, 'editProfile'])->name('edit.profile')->middleware('auth');
    Route::get('/logout', [authController::class, 'logout'])->name('logout');

    // User Books Routes
    Route::get('/books/{id}', [bookController::class, 'getSingleBook'])->name('book')->middleware('auth');
    Route::get('/add-to-favorite/{id}', [bookController::class, 'addToFavorite'])->name('addtofavorite')->middleware('auth');
    Route::get('/favorite-book', [bookController::class, 'favoriteBook'])->name('favorite')->middleware('auth');
    Route::get('/remove-favorite/{id}', [bookController::class, 'removeFavorite'])->name('remove.favorite')->middleware('auth');
});



// Route::get('/', function () {
//     return view('welcome');
// });
