<script>
import { TailwindPagination } from 'laravel-vue-pagination';
import { useUserStore } from "../../stores/user";
    export default {
        data() {
            return {
                books: [],
                search: [],
                booksLength: [],
                perPage: 2,
                sorting: {
                    "col": 'name',
                    "by": 'asc'
                },
                authToken: useUserStore().token
            }
        },
        components: {
            TailwindPagination
        },
        methods: {
            async getBooks (page = 1) {
                await axios.get(`books?page=${page}`, {
                    headers: {
                        'Authorization' : `Bearer ${this.authToken}`
                    },
                    params: {
                        'search': this.search,
                        'sorting': JSON.stringify(this.sorting),
                        'per_page': this.perPage
                    }
                })
                .then(response => {
                    this.books = response.data ?? [];
                    this.booksLength = response.data.data.length;
                    this.sorting = JSON.parse(response.data.sorting);
                })
                .catch(err => {
                    if(err.response.status == 401) {
                        router.push({ name: 'login' })
                    }
                });
            },
            async deleteBooks (id) {
                if (!window.confirm('You sure?')) {
                    return
                }
                await this.destroyBook(id);
            },
            async destroyBook(id) {
                this.errors = ''
                try {
                    await axios.delete(`/books/destroy/${id}`, {
                        headers: {
                            'Authorization' : `Bearer ${this.authToken}`
                        }
                    })
                    await this.getBooks()
                } catch (e) {
                    if (e.response.status === 422) {
                        for (const key in e.response.data.errors) {
                            errors.value = e.response.data.errors
                        }
                    }
                }
            },
            async searchAssign (event) {
                this.search = event.target.value;
                await this.getBooks();
            },
            setUpSorting (th) {
                return {
                    'fa-sort-up': (this.sorting.col === th ? this.sorting.by == 'asc' : ''),
                    'fa-sort-down': (this.sorting.col === th ? this.sorting.by == 'desc' : '')
                }
            },
            async switchSort (col) {
                if(this.sorting.col == col) {
                    if(this.sorting.by == 'asc') {
                        this.sorting.by = 'desc';
                    } else {
                        this.sorting.by = 'asc';
                    }
                } else {
                    this.sorting.col = col;
                    this.sorting.by = 'asc';
                }
                await this.getBooks();
            },
            async recordCount (event) {
                this.perPage = event.target.value;
                await this.getBooks();
            }
        },
        async mounted() {
            await this.getBooks();
        }
    }
</script>

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