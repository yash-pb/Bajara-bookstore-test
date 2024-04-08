<script>
export default {
    data() {
        return {
            users: []
        }
    },
    methods: {
        async fetchUsers() {
            console.log('in users => ', axios.defaults);
            try {
                const response = await axios.get('users', {
                    headers: {
                        'Authorization' : `Bearer ${this.token}`
                    }
                }).then(response => {
                    this.users = response.data.data;
                })
                .catch((err) => {
                    console.log('err => ', err);
                    if (err.response.status === 401) {
                        console.log(err.response.data.message);
                        this.$router.push({ name: 'login' });
                    }
                });
                
            } catch (error) {
                console.error('error => ', error);
            }

        },
    },
    beforeMount(){
        this.fetchUsers();
    },
    computed: {
        token() {
            return localStorage.getItem('token');
        }
    },
    created() {
        // this.$router.options.routes.forEach(route => {
        //     this.items.push({
        //         name: route.name
        //         , path: route.path
        //     })
        // })
        console.log(" => ", this.$router.options.routes);
    }

}
</script>

<template>
    <div class="flex-col sm:flex-row flex sm:items-center justify-between my-3 sm:space-x-2 space-y-2 sm:space-y-0 w-full">
            <h1 class="text-2xl font-bold m-0">Users List</h1>
            <div class="sm:ms-auto flex items-center justify-center space-x-2">
                <input type="search" id="search" name="search" class="block p-2 pl-5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Search user...">
                <router-link :to="{name:'create'}">
                    <button class="ms-auto float-right flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded">Create User</button>
                </router-link>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer">
                                <span> Name </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer">
                                <span> Email </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer">
                                <span> Mobile </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer">
                                <span> Favorite Books </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex flex-row gap-2 cursor-pointer">
                                <span> Status </span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
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
                            <ul>
                                <li v-for="favorite in user.favorite_books" :key="favorite.id">
                                    {{ favorite.book_details.name }}
                                </li>
                            </ul>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-white-50 px-2 py-1 text-xs font-medium text-white-700 ring-1 ring-inset ring-white-600/20">{{ user.status }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-4">
                                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Edit</button>
                                <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</template>