@extends('Layouts.layout')
@section('title')
   Book Store
@stop
@section('content')

<div class="container mx-auto py-6 px-2 sm:px-6 lg:px-8">

    <h1 class="mb-9 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Update Profile</h1>

    @if(Session::has('msg'))
        <div class="bg-{{ Session::get('color') }}-100 border my-5 border-{{ Session::get('color') }}-400 text-{{ Session::get('color') }}-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{Session::get('msg')}}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-{{ Session::get('color') }}-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif

    <form class="w-full" method="post" action="{{ route('user.edit.profile') }}">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="full_name">
              Full Name
            </label>
            <input value="{{ Auth::user()->full_name ?? '' }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="full_name" name="full_name" type="text" placeholder="Enter full name">
            @error('full_name')
                <p class="error text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>
          <div class="w-full md:w-1/2 px-3">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    Email
                </label>
                <input value="{{ Auth::user()->email ?? '' }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" name="email" type="email" placeholder="Enter new email">
                @error('email')
                    <p class="error text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="mobile_no">
              Mobile Number
            </label>
            <input value="{{ Auth::user()->mobile_no ?? '' }}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="mobile_no" name="mobile_no" type="number" placeholder="Enter mobile number">
            @error('mobile_no')
                <p class="error text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-2">
          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                Update
            </button>
          </div>
        </div>
    </form>
</div>

@stop