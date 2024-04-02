<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\FavoriteBook;

class bookController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $books = Book::whereAny([
            'name',
            'description',
        ], 'LIKE', '%'.$search.'%')
        ->get()->toArray();
        
        return view('store.index', compact('books','search'));
    }

    public function getSingleBook($id)
    {
        $book = Book::FindOrFail($id);
        return view('store.detail', compact('book'));
    }

    public function addToFavorite($id)
    {
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
    }

    public function favoriteBook()
    {
        if(Auth::user()) {
            $books = FavoriteBook::leftJoin('books', 'favourite_books.book_id', '=', 'books.id')->where('user_id', Auth::user()->id)->get()->toArray();
            return view('store.favorite', compact('books'));
        }

        return redirect()->route('store.index');
    }

    public function removeFavorite($id)
    {
        $delete = FavoriteBook::where(['user_id' => Auth::user()->id, 'book_id' => $id])->delete();

        return redirect()->route('user.favorite');
    }
}
