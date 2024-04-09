<template>
    <span class="absolute text-white text-2xl top-4 left-4 cursor-pointer" @click="openSidebar()">
        <i class="fa-solid fa-bars px-2 bg-gray-900 rounded-md p-1"></i>
    </span>
    <div class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900 hidden lg:block z-10">
        <div class="text-gray-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center">
                <h1 class="font-bold text-gray-200 ml-3 w-full">
                    <router-link :to="{ name: 'dashboard' }">
                        Admin Panel
                    </router-link>
                </h1>
                <span class="bi bi-x cursor-pointer ml-28 lg:hidden" @click="openSidebar()">&#10005;</span>
            </div>
            <div class="my-2 bg-gray-600 h-[1px]"></div>
        </div>
        <router-link :to="{ name: 'dashboard' }">
            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-house-door-fill"></i>
                <span class="text-[15px] ml-4 text-gray-200 font-bold">Dashboard</span>
            </div>
        </router-link>
        <router-link :to="{ name: 'users' }">
            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-house-door-fill"></i>
                <span class="text-[15px] ml-4 text-gray-200 font-bold">Users</span>
            </div>
        </router-link>
        <router-link :to="{ name: 'books' }">
            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-house-door-fill"></i>
                <span class="text-[15px] ml-4 text-gray-200 font-bold">Books</span>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: 'Sidebar',
        methods: {
            openSidebar: function () {
                document.querySelector(".sidebar").classList.toggle("hidden");
            }
        },
    }
</script>