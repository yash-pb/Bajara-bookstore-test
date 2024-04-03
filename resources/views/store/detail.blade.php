@extends('Layouts.layout')
@section('title')
   Book Page
@stop
@section('content')

@if(Session::has('msg'))
    <div class="bg-{{ Session::get('color') }}-100 border border-{{ Session::get('color') }}-400 text-{{ Session::get('color') }}-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{Session::get('msg')}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-{{ Session::get('color') }}-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
@endif

<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row -mx-4">
        <div class="md:flex-1 px-4">
            <div class="mb-4">
                <img class="w-full h-[250px] lg:h-[450px] rounded object-cover" src="{{ asset('books/'.$book['image']) }}" alt="book image">
            </div>
            <div class="flex mb-4">
                <div class="w-1/2 mt-3 flex flex-row md:flex-row">
                    <a href="{{ route('user.addtofavorite', $book->id) }}" class="text-gray-800 rounded-full font-bold">
                        @if (in_array($book->id, array_column(Auth::user()->books->toArray(), 'book_id')))
                            <a href="{{ route('user.remove.favorite', $book['id']) }}">
                                <i class="fa-solid fa-heart h-10 w-10 text-red-500"></i>
                            </a>
                        @else
                            <a href="{{ route('user.addtofavorite', $book['id']) }}">
                                <i class="fa-regular fa-heart h-10 w-10 text-red-500"></i>                          
                            </a>
                        @endif
                    </a>
                </div>
            </div>
        </div>
        <div class="md:flex-1 px-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $book->name }}</h2>
            <div>
                <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                    {{ $book->description }}
                </p>
            </div>
        </div>
    </div>
</div>

@stop