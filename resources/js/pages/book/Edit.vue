<script>
import { useUserStore } from "../../stores/user";
export default {
    data() {
        return {
            authToken: useUserStore().token,
            errors: '',
            book: {},
            id: this.$route.params.id
        }
    },
    methods: {
        async getBook (id) {
            let response = await axios.get(`/books/${this.id}`, {
                headers: {
                    'Authorization' : `Bearer ${this.authToken}`
                }
            }).
            then(response => {
                this.book = response.data.data
            }).catch(err => {
                if (err.response.status === 404) {
                    this.$router.push({name: 'books'})
                }
            })
        },
        async updateBook () {
            this.errors = '';
            try {
                await axios.post(`/update-book/${this.id}`, this.book, {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'Authorization' : `Bearer ${this.authToken}`
                    }
                })
                this.$router.push({name: 'books'})
            } catch (e) {
                if (e.response.status === 422) {
                    for (const key in e.response.data.errors) {
                        this.errors = e.response.data.errors
                    }
                }
            }
        },
        onFileChange (e) {
            this.book.cover_image = e.target.files[0];
        }
    },
    async mounted() {
        await this.getBook();
    }
}
</script>

<template>
    
    <h1 class="text-center text-2xl font-bold my-3">Update Book</h1>

    <form class="w-full" @submit.prevent="updateBook" enctype="multipart/form-data">
        <div class="flex flex-wrap -mx-3 mb-4">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                Book Name
            </label>
            <input id="name" v-model="book.name" name="name" type="text" placeholder="Enter book name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <p class="error text-red-500 text-xs italic" v-if="errors?.name">{{ errors.name[0] }}</p>
        </div>
        
        <div class="w-full md:w-1/2 px-3">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    Description
                </label>
                <textarea name="description" v-model="book.description" class="py-3 px-4 resize-y rounded-md w-full md:resize border border-gray-200 focus:border-gray-500 bg-gray-200 focus:bg-white">
                </textarea>
                <p class="error text-red-500 text-xs italic" v-if="errors?.description">{{ errors.description[0] }}</p>
            </div>
        </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                    Price
                </label>
                <input name="price" v-model="book.price" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="price" type="number" placeholder="Enter price">
                <p class="error text-red-500 text-xs italic" v-if="errors?.price">{{ errors.price[0] }}</p>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
                    Status
                </label>
                <div class="relative">
                    <select name="status" v-model="book.status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="status">
                        <option value="">Select Option</option>
                        <option value="Active">Active</option>
                        <option value="In-active">In-Active</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                <p class="error text-red-500 text-xs italic" v-if="errors?.status">{{ errors.status[0] }}</p>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                    Upload Cover Image
                </label>
                <input name="cover_image" v-on:change="onFileChange" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                <p class="error text-red-500 text-xs italic" v-if="errors?.cover_image">{{ errors.cover_image[0] }}</p>
                <div class="image-preview" id="image-preview">
                    Cover Image Preview
                </div>
                <img :src="book.cover_image" class="h-12 w-12 rounded object-cover cursor-pointer" v-if="book.cover_image" />
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-4">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <button type="submit" class="mr-2 flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                Save
            </button>
            <router-link :to="{name:'books'}">
                <button type="button" class="flex-shrink-0 bg-gray-500 hover:bg-gray-700 border-gray-500 hover:border-gray-700 text-sm border-4 text-white py-1 px-2 rounded">
                    Cancel
                </button>
            </router-link>
        </div>
        </div>
    </form>
</template>