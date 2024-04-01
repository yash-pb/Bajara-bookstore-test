<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\FavoriteBook;


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

Route::get('/', function () {
    $books = Book::all()->toArray();
    // dd($books);
    return view('store.index', compact('books'));
})->name('store.index');


Route::name('user.')->group(function () {
    Route::get('/login', function () {
        return view('store.login');
    })->name('login');
    
    Route::post('/login', function (Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('store.index');
        }

        return redirect()->route('user.login')->with([
            'msg' => 'Credential not matched',
        ]);

    })->name('verify');

    Route::get('/books/{id}', function ($id) {
        $book = Book::FindOrFail($id);
        return view('store.detail', compact('book'));
    })->name('book')->middleware('auth');

    Route::get('/add-to-favorite/{id}', function ($id) {
        if(FavoriteBook::where(['user_id' => Auth::user()->id, 'book_id' => $id])->exists()) {
            return back()->with([
                'msg' => 'Book Already Added',
                'color' => 'red'
            ]);
        } else {
            $favorite = FavoriteBook::create([
                'book_id' => $id,
                'user_id' => Auth::user()->id,
            ]);

            return back()->with([
                'msg' => 'Book Added into favorite',
                'color' => 'green'
            ]);
        }

    })->name('addtofavorite')->middleware('auth');

    Route::get('/favorite-book', function (Request $request) {
        if(Auth::user()) {
            $books = FavoriteBook::leftJoin('books', 'favourite_books.book_id', '=', 'books.id')->where('user_id', Auth::user()->id)->get()->toArray();
            return view('store.favorite', compact('books'));
        }

        return redirect()->route('store.index');
    })->name('favorite')->middleware('auth');

    Route::get('/logout', function (Request $request) {
        Auth::logout();
        return redirect()->route('store.index');
    })->name('logout');
});



// Route::get('/', function () {
//     return view('welcome');
// });
