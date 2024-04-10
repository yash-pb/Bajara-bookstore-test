<script>
import { TailwindPagination } from 'laravel-vue-pagination';
import { useAuthTokenStore } from "../../stores/authToken";

export default {
    data() {
        return {
            authToken: useAuthTokenStore().token,
            users: [],
            search: '',
            usersLength: 0,
            sorting: {
                "col": 'full_name',
                "by": 'asc'
            },
            perPage: 2
        }
    },
    components: {
        TailwindPagination
    },
    methods: {
        async fetchUsers(page=1) {
            try {
                await axios.get(`users?page=${page}`, {
                    headers: {
                        'Authorization' : `Bearer ${this.authToken}`
                    },
                    params: {
                        'search': this.search,
                        'sorting': JSON.stringify(this.sorting),
                        'per_page': this.perPage
                    }
                }).then(response => {
                    this.users = response.data ?? [];
                    this.usersLength = response.data.data.length;
                    this.sorting = JSON.parse(response.data.sorting);
                })
                .catch((err) => {
                    if (err.response.status === 401) {
                        console.log(err.response.data.message);
                        this.$router.push({ name: 'login' });
                    }
                });
                
            } catch (error) {
                console.error('error => ', error);
            }
        },
        async deleteUser (id) {
            if (!window.confirm('You sure?')) {
                return
            }
            await this.destroyUser(id);
        },
        async destroyUser(id) {
            this.errors = ''
            try {
                await axios.delete(`/users/destroy/${id}`, {
                    headers: {
                        'Authorization' : `Bearer ${this.authToken}`
                    }
                })
                await this.fetchUsers();
            } catch (e) {
                if (e.response.status === 422) {
                    for (const key in e.response.data.errors) {
                        this.errors = e.response.data.errors
                    }
                }
            }
        },
        async searchAssign(event) {
            this.search = event.target.value;
            this.fetchUsers();
        },
        async switchSort(col) {
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
            this.fetchUsers();
        },
        async recordCount(event) {
            this.perPage = event.target.value;
            this.fetchUsers();
        },
        setUpSorting(th) {
            return {
                'fa-sort-up': (this.sorting.col === th ? this.sorting.by == 'asc' : ''),
                'fa-sort-down': (this.sorting.col === th ? this.sorting.by == 'desc' : '')
            }
        },
    },
    beforeMount(){
        this.fetchUsers();
    }
}
</script>

<template>
    <div class="flex-col sm:flex-row flex sm:items-center justify-between my-3 sm:space-x-2 space-y-2 sm:space-y-0 w-full">
        <h1 class="text-2xl font-bold m-0">Users List</h1>
        <div class="sm:ms-auto flex items-center justify-center space-x-2">
            <select id="record" @change="recordCount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-25 p-2.5">
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
            <input type="search" v-model="search" id="search" name="search" @keyup="searchAssign" class="block p-2 pl-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Search user...">
            <button class="ms-auto float-right flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">
                <router-link :to="{name:'user.create'}">
                    Create User
                </router-link>
            </button>
        </div>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer" @click="switchSort('full_name')">
                            <span> Name </span>
                            <span> <i class="fa-solid align-middle" :class="setUpSorting('full_name')"></i> </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer" @click="switchSort('email')">
                            <span> Email </span>
                            <span> <i class="fa-solid align-middle" :class="setUpSorting('email')"></i> </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer" @click="switchSort('mobile_no')">
                            <span> Mobile </span>
                            <span> <i class="fa-solid align-middle" :class="setUpSorting('mobile_no')"></i> </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer" @click="switchSort('status')">
                            <span> Status </span>
                            <span> <i class="fa-solid align-middle" :class="setUpSorting('status')"></i> </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex flex-row gap-2 cursor-pointer">
                            <span> Favorite Books </span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ user.full_name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ user.email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ user.mobile_no }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center rounded-md bg-white-50 px-2 py-1 text-xs font-medium text-white-700 ring-1 ring-inset ring-white-600/20">{{ user.status }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <ul>
                            <li v-for="favorite in user.favorite_books" :key="favorite.id">
                                {{ favorite.book_details.name }}
                            </li>
                        </ul>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-4">
                            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                <router-link :to="{name:'user.edit', params: { id: user.id }}">
                                    Edit
                                </router-link>
                            </button>
                            <button @click="deleteUser(user.id)" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr v-if="usersLength === 0">
                    <td colspan="6" align="center"> No User Found </td>
                </tr>
            </tbody>
        </table>
    </div>
    <TailwindPagination
        :data="users"
        @pagination-change-page="fetchUsers"
    />
</template>