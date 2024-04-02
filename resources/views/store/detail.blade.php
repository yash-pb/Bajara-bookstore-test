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

<div class="container mx-auto mt-5">
    <div class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img class="w-full h-full object-cover" src="{{ asset('books/'.$book['image']) }}" alt="book image">
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2 mt-3 flex flex-row md:flex-row">
                            <a href="{{ route('user.addtofavorite', $book->id) }}" class="dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">
                                @if (in_array($book->id, array_column(Auth::user()->books->toArray(), 'book_id')))
                                    <svg class="h-8 w-8 text-red-500 fill-current text-red-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg> 
                                @else
                                    <svg class="h-8 w-8 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>                              
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="md:flex-1 px-4 mt-3">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $book->title }}</h2>
                    <div>
                        <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                            {{ $book->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

@stop