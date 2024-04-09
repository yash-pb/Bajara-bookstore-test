<script>
export default {
    data() {
        return {
            totalUsers: 0,
            totalBooks: 0
        }
    },
    methods: {
        async getStates() {
            await axios.get(`get-states`, {
                headers: {
                    'Authorization' : `Bearer ${this.token}`
                }
            })
            .then(response => {
                console.log('response => ', response);
                this.totalUsers = response.data.totalUsers ?? [];
                this.totalBooks = response.data.totalBooks;
            })
            .catch(err => {
                if(err.response.status == 401) {
                    router.push({ name: 'login' })
                }
            });
        }
    },
    computed: {
        token() {
            return localStorage.getItem('token');
        }
    },
    async mounted() {
        await this.getStates();
    }
}
</script>

<template>
<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6 w-full max-w-6xl">
    <router-link :to="{ name: 'users' }">
        <div class="flex items-center p-4 bg-gray-200 rounded">
            <div class="flex-grow flex flex-col ml-4">
                <span class="text-xl font-bold">{{ this.totalUsers }}</span>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500">Total Users</span>
                </div>
            </div>
        </div>
    </router-link>

    <router-link :to="{ name: 'books' }">
        <div class="flex items-center p-4 bg-gray-200 rounded">
           <div class="flex-grow flex flex-col ml-4">
              <span class="text-xl font-bold">{{ this.totalBooks }}</span>
              <div class="flex items-center justify-between">
                    <span class="text-gray-500">Total Books</span>
              </div>
           </div>
        </div>
    </router-link>
</div>
</template>