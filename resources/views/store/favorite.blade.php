@extends('Layouts.layout')
@section('title')
   Favorite Book
@stop
@section('content')

<div class="container mx-auto mt-3">
    <div class="grid grid-cols-4 gap-4">
        @foreach ($books as $book)
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" src="{{ asset('books/'.$book['cover_image']) }}" alt="book cover">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $book['name'] }}</div>
                    <p class="text-gray-700 text-base truncate ...">
                        {{ $book['description'] }}
                    </p>
                    <div class="pt-4 pb-2">
                        <a href="{{ route('user.book', $book['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@stop