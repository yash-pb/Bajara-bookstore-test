@extends('Layouts.layout')
@section('title')
   Favorite Book
@stop
@section('content')

<div class="container mx-auto py-6 px-2 sm:px-6 lg:px-8">
    <div class="grid grid-cols-4 gap-4">
        @forelse ($books as $book)
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full h-48 object-cover" src="{{ asset('books/'.$book['cover_image']) }}" alt="book cover">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between mb-2">
                        <div class="font-bold text-xl">{{ $book['name'] }}</div>
                        <a href="{{ route('user.remove.favorite', $book['id']) }}">
                            <i class="fa-solid fa-heart h-7 w-7 text-red-500"></i>
                        </a>
                    </div>
                    <p class="text-gray-700 text-base truncate ...">
                        {{ $book['description'] }}
                    </p>
                    <div class="pt-4 pb-2">
                        <a href="{{ route('user.book', $book['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Read more</a>
                    </div>
                </div>
            </div>
        @empty
            <div>
                No favorite books found.
            </div>
        @endforelse
    </div>
</div>

@stop