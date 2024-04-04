<div>
    @if($updateMode || $createMode)
        @include('livewire.user.create')
    @else
        <div class="flex-col sm:flex-row flex sm:items-center justify-between my-3 sm:space-x-2 space-y-2 sm:space-y-0 w-full">
            <h1 class="text-2xl font-bold m-0">Users List</h1>
            <div class="sm:ms-auto flex items-center justify-center space-x-2">
                <input type="search" wire:model="search" wire:keydown="searchData()" value="{{ $search }}" id="search" name="search" class="block p-2 pl-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Search user...">
                <button wire:click="createUsers()" class="ms-auto float-right flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">Create User</button>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer" wire:model="sortCol" wire:click="sortingData('full_name')">
                                <span> Name </span>
                                <span> <i class="fa-solid fa-sort-{{ sortArrowMatch($sortCol, 'full_name', $sortCls) }} align-middle" wire:model="sortBy"></i> </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer" wire:model="sortCol" wire:click="sortingData('email')">
                                <span> Email </span>
                                <span> <i class="fa-solid fa-sort-{{ sortArrowMatch($sortCol, 'email', $sortCls) }} align-middle" wire:model="sortBy"></i> </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer" wire:model="sortCol" wire:click="sortingData('mobile_no')">
                                <span> Mobile </span>
                                <span> <i class="fa-solid fa-sort-{{ sortArrowMatch($sortCol, 'mobile_no', $sortCls) }} align-middle" wire:model="sortBy"></i> </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer" wire:model="sortCol" wire:click="sortingData('status')">
                                <span> Status </span>
                                <span> <i class="fa-solid fa-sort-{{ sortArrowMatch($sortCol, 'status', $sortCls) }} align-middle" wire:model="sortBy"></i> </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->full_name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->mobile_no }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md bg-{{ $user->status == 'Active' ? 'green' : 'red' }}-50 px-2 py-1 text-xs font-medium text-{{ $user->status == 'Active' ? 'green' : 'red' }}-700 ring-1 ring-inset ring-{{ $user->status == 'Active' ? 'green' : 'red' }}-600/20">{{ $user->status }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-4">
                                    <button wire:click="editUser({{$user->id}})" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Edit</button>
                                    <button wire:confirm="Are you sure you want to delete this user?"
                                    wire:click="deleteUser({{$user->id}})" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="5" align="center">
                                No Users Found.
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