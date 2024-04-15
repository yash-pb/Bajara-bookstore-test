<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteBook;


class Home extends Component
{
    public $books, $isLiked = false;

    public function mount() {
        $this->books = Book::where('status', 1)
        ->get()->toArray();
    }

    public function render() {
        return view('livewire.store.Home');
    }

    public function toggleLike($bookId) {
        if(Auth::user()) {
            if(FavoriteBook::where(['user_id' => Auth::user()->id, 'book_id' => $bookId])->exists()) {
                $favorite = FavoriteBook::where([
                    'book_id' => $bookId,
                    'user_id' => Auth::user()->id,
                ])->delete();
                session()->flash('msg', 'Book removed from favorite.');
                session()->flash('color', 'red');
                $this->isLiked = false;
            } else {
                $favorite = FavoriteBook::create([
                    'book_id' => $bookId,
                    'user_id' => Auth::user()->id,
                ]);
                session()->flash('msg', 'Book Added into favorite.');
                session()->flash('color', 'green');
                $this->isLiked = true;
            }
        } else {
            session()->flash('msg', 'First do login.');
            session()->flash('color', 'red');
        }
    }
}
