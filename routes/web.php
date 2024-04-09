<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\user\authController;
use App\Http\Controllers\user\bookController;
use App\Models\User;
use App\Models\Book;


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
// middleware(['guest']);

// User Routes
Route::name('user.')->group(function () {
    // User Auth Route
    Route::match(['get','post'],'/register', [authController::class, 'register'])->name('register');
    Route::match(['get','post'],'/login', [authController::class, 'login'])->name('login')->middleware('guest');
    Route::match(['get','post'],'/forgot-password', [authController::class, 'forgotPassword'])->name('forgot.password')->middleware('guest');
    Route::match(['get','post'],'/change-password', [authController::class, 'changePassword'])->name('change.password')->middleware('guest');
    Route::match(['get','post'],'/edit-profile', [authController::class, 'editProfile'])->name('edit.profile')->middleware('auth');
    Route::get('/logout', [authController::class, 'logout'])->name('logout');

    // User Books Routes
    Route::get('/books/{id}', [bookController::class, 'getSingleBook'])->name('book')->middleware('auth');
    Route::get('/add-to-favorite/{id}', [bookController::class, 'addToFavorite'])->name('addtofavorite')->middleware('auth');
    Route::get('/favorite-book', [bookController::class, 'favoriteBook'])->name('favorite')->middleware('auth');
    Route::get('/remove-favorite/{id}', [bookController::class, 'removeFavorite'])->name('remove.favorite')->middleware('auth');
});

Route::group(['prefix' => 'admin/livewire','as' => 'admin.livewire.', 'middleware' => ['auth', 'role']], function () {
    Route::get('/dashboard', function () {
        $totalUsers = User::where('user_type', 2)->count();
        $totalBooks = Book::count();
        return view('admin.dashboard', compact('totalUsers', 'totalBooks'));
    })->name('dashboard');

    Route::group(['prefix' => 'users','as' => 'users.'], function () {
        Route::get('/', function(){
            return view('admin.users');
        })->name('list');
    });

    Route::group(['prefix' => 'books','as' => 'books.'], function () {
        Route::get('/', function(){
            return view('admin.books');
        })->name('list');
    });
});
// middleware(['guest']);

// Vue Admin Route
// Route::get('admin/vue/login', function () {
//     return view('auth');
// })->name('admin.vue');


Route::get('admin/vue/{any?}', function () {
    return view('panel');
})->name('admin.vue');

Route::get('test', function () {
    dd(date('Y-m-d H:i:s'));
});