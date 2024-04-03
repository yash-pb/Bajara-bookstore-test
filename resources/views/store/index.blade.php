@extends('Layouts.layout')
@section('title')
   Book Store
@stop
@section('content')

@if(Session::has('msg'))
    <p class="error text-{{Session::get('color')}}-500 text-xs text-bold text-center my-5">{{Session::get('msg')}}</p>
@endif

<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($books as $book)
            <div class="max-w-sm rounded-lg overflow-hidden shadow-xl">
                <img class="w-full h-48 object-cover" src="{{ asset('books/'.$book['cover_image']) }}" alt="book cover">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-bold text-xl">{{ $book['name'] }}</div>
                        @if (Auth::user())    
                            @if (in_array($book['id'], array_column(Auth::user()->books->toArray(), 'book_id')))
                                <a href="{{ route('user.remove.favorite', $book['id']) }}">
                                    <i class="fa-solid fa-heart h-7 w-7 text-red-500"></i>
                                </a>
                            @else
                                <a href="{{ route('user.addtofavorite', $book['id']) }}">
                                    <i class="fa-regular fa-heart h-7 w-7 text-red-500"></i>                          
                                </a>
                            @endif
                        @else
                            <a href="{{ route('user.addtofavorite', $book['id']) }}">
                                <i class="fa-regular fa-heart h-7 w-7 text-red-500"></i>                          
                            </a>
                        @endif
                    </div>
                    <p class="text-gray-700 text-base truncate ...">
                        {{ $book['description'] }}
                    </p>
                    <div class="pt-4 pb-2">
                        <a href="{{ route('user.book', $book['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div>
                No Books Found
            </div>
        @endforelse
    </div>
</div>

@stop