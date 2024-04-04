<div>
    @if($updateMode)
        @include('livewire.book.update')
    @elseif ($createMode)
        @include('livewire.book.create')
    @else
        {{-- {{ dd($this) }} --}}
        <div class="flex-col sm:flex-row flex sm:items-center justify-between my-3 sm:space-x-2 space-y-2 sm:space-y-0 w-full">
            <h1 class="text-2xl font-bold m-0">Books List</h1>
            <div class="sm:ms-auto flex items-center justify-center space-x-2">
                <input type="search" wire:model="search" wire:keydown="searchData()" value="{{ $search }}" id="search" name="search" class="block p-2 pl-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Search books...">
                <button wire:click="createBooks()" class="ms-auto float-right flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">Create Book</button>
            </div>
        </div>
        {{-- {{ print_r($books) }} --}}
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer" wire:model="sortCol" wire:click="sortingData('name')">
                                <span> Book Name </span>
                                <span> <i class="fa-solid fa-sort-{{ sortArrowMatch($sortCol, 'name', $sortCls) }} align-middle" wire:model="sortBy"></i> </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer" wire:model="sortCol" wire:click="sortingData('description')">
                                <span> Description </span>
                                <span> <i class="fa-solid fa-sort-{{ sortArrowMatch($sortCol, 'description', $sortCls) }} align-middle" wire:model="sortBy"></i> </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer" wire:model="sortCol" wire:click="sortingData('price')">
                                <span> Price </span>
                                <span> <i class="fa-solid fa-sort-{{ sortArrowMatch($sortCol, 'price', $sortCls) }} align-middle" wire:model="sortBy"></i> </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer" wire:model="sortCol" wire:click="sortingData('status')">
                                <span> Status </span>
                                <span> <i class="fa-solid fa-sort-{{ sortArrowMatch($sortCol, 'status', $sortCls) }} align-middle" wire:model="sortBy"></i> </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cover Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)    
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $book->name }}
                            </th>
                            <td class="px-6 py-4">
                                <p class="m-0 truncate max-w-64">{{ $book->description }}</p>
                            </td>
                            <td class="px-6 py-4">
                                {{ $book->price }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md bg-{{ $book->status == 'Active' ? 'green' : 'red' }}-50 px-2 py-1 text-xs font-medium text-{{ $book->status == 'Active' ? 'green' : 'red' }}-700 ring-1 ring-inset ring-{{ $book->status == 'Active' ? 'green' : 'red' }}-600/20">{{ $book->status }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ asset('books/'.$book->cover_image) }}" data-fancybox="gallery">
                                    <img class="h-12 w-12 rounded object-cover cursor-pointer" src="{{ asset('books/'.$book->cover_image) }}">
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-4">
                                    <button wire:click="editBook({{$book->id}})" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Edit</button>
                                    <button wire:confirm="Are you sure you want to delete this book?"
                                    wire:click="deleteBook({{$book->id}})" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="5" align="center">
                                No Books Found.
                            </th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
    <div class="pagination-section my-3 float-right">
        {{ $paginatedData->links('pagination::tailwind') }}
    </div>
</div>
