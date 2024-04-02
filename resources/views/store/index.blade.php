@extends('Layouts.layout')
@section('title')
   Book Store
@stop
@section('content')

<div class="container mx-auto py-6 px-2 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @forelse ($books as $book)
            <div class="max-w-sm rounded-lg overflow-hidden shadow-xl">
                <img class="w-full h-48 object-cover" src="{{ asset('books/'.$book['cover_image']) }}" alt="book cover">
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
        @empty
            <div>
                No Books Found
            </div>
        @endforelse
    </div>
</div>

@stop