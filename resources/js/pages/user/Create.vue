<script setup>
import { reactive, ref } from 'vue';
// import { useRoute } from 'vue-router'
// console.log('this => ', this);
// const router = useRoute();
// router.push({ path: 'users' })
 
const errors = ref({})

const user = reactive({
    full_name: '',
    email: '',
    mobile_no: '',
    status: ''
});

function storeUser() {
    axios
    .post('store-user', user, {
        headers: {
            'Authorization' : `Bearer ${localStorage.getItem('token')}`
        }
    })
    .then(response => {
        if(response.status === 200) {
            window.location.href = '/admin/vue/users';
        }
    })
    .catch((err) => {
        if (err.response.status === 422) {
            errors.value = err.response.data.errors
        }
    });
}
</script>

<template>
    
    <h1 class="text-center text-2xl font-bold my-3">Create User</h1>

    <form class="w-full" @submit.prevent="storeUser" enctype="multipart/form-data">
        <div class="flex flex-wrap -mx-3 mb-4">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                    Full Name
                </label>
                <input v-model="user.full_name" id="name" name="full_name" type="text" placeholder="Enter user name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <p class="error text-red-500 text-xs italic" v-if="errors?.full_name">{{ errors.full_name[0] }}</p>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        Mobile Number
                    </label>
                    <input v-model="user.mobile_no" type="number" name="mobile_no" placeholder="Enter mobile number" class="py-3 px-4 resize-y rounded-md w-full md:resize border border-gray-200 focus:border-gray-500 bg-gray-200 focus:bg-white">
                    <p class="error text-red-500 text-xs italic" v-if="errors?.mobile_no">{{ errors.mobile_no[0] }}</p>
                </div>
            </div>    
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                    Email
                </label>
                <input v-model="user.email" name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="Enter email">
                <p class="error text-red-500 text-xs italic" v-if="errors?.email">{{ errors.email[0] }}</p>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
                    Status
                </label>
                <div class="relative">
                    <select v-model="user.status" name="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="status">
                        <option value="">Select Option</option>
                        <option value="Active">Active</option>
                        <option value="In-active">In-Active</option>
                    </select>
                    <p class="error text-red-500 text-xs italic" v-if="errors?.status">{{ errors.status[0] }}</p>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-4">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <button type="submit" class="mr-2 flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                Save
            </button>
            <router-link :to="{name:'users'}">
                <button type="button" class="flex-shrink-0 bg-gray-500 hover:bg-gray-700 border-gray-500 hover:border-gray-700 text-sm border-4 text-white py-1 px-2 rounded">
                    Cancel
                </button>
            </router-link>
        </div>
        </div>
    </form>
</template>