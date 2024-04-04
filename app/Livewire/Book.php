<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book as BookModel;
use Livewire\WithFileUploads;


class Book extends Component
{
    // Declare Properties
    use WithFileUploads;
    public $books, $name, $description, $bookId, $price, $cover_image, $status, $updateMode, $createMode, $images = false;
    public $search = "";
    public $sortCol = 'name';
    public $sortBy = "asc";
    public $sortCls = "up";
    protected $rules = [
        'name' => 'required',
        'description' => 'required|max:255',
        'price' => 'required',
        'status' => 'required',
        'images' => 'required|mimes:jpeg,jpg,png'
    ];

    // Render Method
    public function render()
    {
        $this->books = BookModel::select('id', 'name', 'description', 'price', 'cover_image', 'status')
        ->where('name', 'LIKE', '%'.$this->search.'%')->orderBy($this->sortCol, $this->sortBy)->get();
        return view('livewire.book.book');
    }

    // Soring Logic
    public function sortingData($name)
    {
        $this->sortCol = $name;
        if($this->sortBy == 'asc') {
            $this->sortBy = 'desc';
            $this->sortCls = 'down';
        } else if ($this->sortBy == 'desc') {
            $this->sortBy = 'asc';
            $this->sortCls = 'up';
        } else {
            $this->sortBy = 'asc';
            $this->sortCls = 'up';
        }
    }

    // Searching method
    public function searchData(){}

    // Edit Method
    public function editBook($id)
    {
        try {
            $book = BookModel::findOrFail($id);
            if( !$book) {
                session()->flash('error','Book not found');
            } else {
                $this->bookId = $book->id;
                $this->name = $book->name;
                $this->description = $book->description;
                $this->price = $book->price;
                $this->cover_image = $book->cover_image;
                $this->status = $book->status;
                $this->updateMode = true;
            }

        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }

    // Create New method
    public function createBooks()
    {
        $this->resetFields();
        $this->createMode = true;
        $this->updateMode = false;
    }

    // Save data method
    public function storeBook()
    {
        $this->validate();
        $fileName = null;
        if($this->images) {
            $fileName = time() . '.' . $this->images->getClientOriginalExtension();
            $this->images->storeAs('books', $fileName, ['disk' => 'books']);
        }
        try {
            BookModel::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'status' => $this->status,
                'cover_image' => $fileName,
            ]);
            session()->flash('success','Book Created Successfully!!');
            $this->resetFields();
            $this->createMode = false;
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }

    // Update method
    public function updateBook(BookModel $book)
    {
        $this->rules['images'] = 'mimes:jpeg,jpg,png';
        $this->validate();
        $fileName = $this->cover_image;
        if($this->images) {
            $fileName = time() . '.' . $this->images->getClientOriginalExtension();
            $this->images->storeAs('books', $fileName, ['disk' => 'books']);
        }
        try {
            BookModel::whereId($this->bookId)->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'status' => $this->status == 'Active' ? 1 : 2,
                'cover_image' => $fileName,
            ]);
            session()->flash('success','Book Updated Successfully!!');
            $this->resetFields();
            $this->updateMode = false;
        } catch (\Exception $ex) {
            session()->flash('success','Something goes wrong!!');
        }
    }

    // Delete method
    public function deleteBook($id)
    {
        try{
            BookModel::find($id)->delete();
            session()->flash('success',"Book Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }

    // Cancel method
    public function cancelBook()
    {
        $this->resetFields();
        $this->updateMode = false;
        $this->createMode = false;
    }

    // Reset field method
    public function resetFields(){
        $this->name = '';
        $this->description = '';
        $this->description = '';
        $this->bookId = '';
        $this->price = '';
        $this->cover_image = '';
        $this->images = '';
        $this->status = '';
    }
}
