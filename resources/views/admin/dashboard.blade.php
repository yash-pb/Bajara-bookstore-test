@extends('Layouts.adminLayout')
@section('title')
   Admin Dashboard
@stop
@section('content')

<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6 w-full max-w-6xl">
      <!-- Tile 1 -->
   <div class="flex items-center p-4 bg-gray-200 rounded">
      <div class="flex-grow flex flex-col ml-4">
         <span class="text-xl font-bold">{{ $totalUsers }}</span>
         <div class="flex items-center justify-between">
               <span class="text-gray-500">Total Users</span>
         </div>
      </div>
   </div>

   <div class="flex items-center p-4 bg-gray-200 rounded">
      <div class="flex-grow flex flex-col ml-4">
         <span class="text-xl font-bold">{{ $totalBooks }}</span>
         <div class="flex items-center justify-between">
               <span class="text-gray-500">Total Books</span>
         </div>
      </div>
   </div>
</div>

@stop