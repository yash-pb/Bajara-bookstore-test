<template>
    <nav class="bg-gray-200 lg:ml-[18rem] w-auto">
        <div class="mx-auto container px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center lg:items-stretch lg:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <!-- <a href="{{ route('admin.livewire.dashboard') }}"> -->
                            <h1 class="text-2xl font-bold">Admin Panel</h1>
                        <!-- </a> -->
                    </div>
                </div>
                <!-- <button v-if="loggedIn" @click="setLogin()">Logout</button> -->
                <div class="">
                    <span class="mr-3">{{ user.full_name }}</span>
                    <a href="#" @click="logout" class="font-medium text-blue-600 hover:underline">Log out</a>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { useUserStore } from "../stores/user";
// const userStore = useUserStore();

export default {
  name: 'Header',
  data() {
    return {
        user: useUserStore().user
    }
  },
  methods: {
    async logout() {
        axios
        .get('logout', {
            headers: {
                'Authorization' : `Bearer ${useUserStore().token}`
            },
        })
        .then(response => {
            if(response.status === 200) {
                localStorage.removeItem('token');
                this.$router.push({ name: 'login' });
            }
        })
        .catch((err) => {
            if (err.response.status === 422) {
                console.log(err.response.data.message);
            }
        })
        .finally(() => this.loading = false)
    }
  }
}
</script>