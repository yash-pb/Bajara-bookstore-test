
<template>
    <div class="flex-col sm:flex-row flex sm:items-center justify-between my-3 sm:space-x-2 space-y-2 sm:space-y-0 w-full">
        <h1 class="text-2xl font-bold m-0">Books List</h1>
        <div class="sm:ms-auto flex items-center justify-center space-x-2">
            <select id="record" @change="recordCount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-25 p-2.5">
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
            <input type="search" id="search" v-model="search" v-on:keyup="searchAssign" name="search" class="block p-2 pl-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Search books...">
            <button class="ms-auto float-right flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">
                <router-link :to="{name: 'book.create'}">
                    Create Book
                </router-link>
            </button>
        </div>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer" @click="switchSort('name')">
                            <span> Name </span>
                            <span> <i class="fa-solid align-middle" :class="setUpSorting('name')"></i> </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer" @click="switchSort('description')">
                            <span> Description </span>
                            <span> <i class="fa-solid align-middle" :class="setUpSorting('description')"></i> </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer" :class="setUpSorting('price')" @click="switchSort('price')">
                            <span> Price </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer" :class="setUpSorting('status')" @click="switchSort('status')">
                            <span> Status </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books.data" :key="book.id">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ book.name }}
                    </th>
                    <td class="m-0 truncate max-w-64">
                        {{ book.description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ book.price }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center rounded-md bg-white-50 px-2 py-1 text-xs font-medium text-white-700 ring-1 ring-inset ring-white-600/20">{{ book.status }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-4">
                            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                <router-link :to="{name:'book.edit', params: { id: book.id }}">
                                    Edit
                                </router-link>
                            </button>
                            <button @click="deleteBooks(book.id)" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr v-if="booksLength === 0">
                    <td colspan="5" align="center"> No Books Found </td>
                </tr>
            </tbody>
        </table>
    </div>
    <TailwindPagination
      :data="books"
      @pagination-change-page="getBooks"
    />
</template>

<script setup>
import useBooks from "../../composables/books";
import { onMounted } from 'vue';
import { TailwindPagination } from 'laravel-vue-pagination';
 
const { books, search, sorting, perPage, booksLength, getBooks, destroyBook } = useBooks() 
onMounted(getBooks)

const deleteBooks = async (id) => {
    if (!window.confirm('You sure?')) {
        return
    }
 
    await destroyBook(id)
}

const searchAssign = (event) => {
    search.value = event.target.value;
    getBooks()
}

const setUpSorting = (th) => {
    return {
        'fa-sort-up': (sorting.value.col === th ? sorting.value.by == 'asc' : ''),
        'fa-sort-down': (sorting.value.col === th ? sorting.value.by == 'desc' : '')
    }
}

const switchSort = (col) => {
    if(sorting.value.col == col) {
        if(sorting.value.by == 'asc') {
            sorting.value.by = 'desc';
        } else {
            sorting.value.by = 'asc';
        }
    } else {
        sorting.value.col = col;
        sorting.value.by = 'asc';
    }
    getBooks();
}

const recordCount = (event) => {
    perPage.value = event.target.value;
    getBooks();
}
</script>