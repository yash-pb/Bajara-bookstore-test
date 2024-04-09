import { ref } from 'vue'
import { useRouter } from 'vue-router'

export default function useBooks() {
    const book = ref([])
    const books = ref([])
    const search = ref([])
    const booksLength = ref([])
    const perPage = ref(2)
    const sorting = ref({
        "col": 'name',
        "by": 'asc'
    })
 
    const errors = ref('')
    const router = useRouter()

    const getToken = () => {
        return localStorage.getItem('token');
    }

    const getBooks = async (page = 1) => {
        console.log('perPage => ', perPage.value);
        let response = await axios.get(`books?page=${page}`, {
            headers: {
                'Authorization' : `Bearer ${getToken()}`
            },
            params: {
                'search': search.value,
                'sorting': JSON.stringify(sorting.value),
                'per_page': perPage.value
            }
        }).catch(err => {
            if(err.response.status == 401) {
                router.push({ name: 'login' })
            }
        });
        books.value = response.data;
        booksLength.value = response.data.data.length;
        sorting.value = JSON.parse(response.data.sorting);
    }

    const storeBook = async (data) => {
        errors.value = ''
        try {
            await axios.post('/store-book', data, {
                headers: {
                    'content-type': 'multipart/form-data',
                    'Authorization' : `Bearer ${getToken()}`
                }
            })
            await router.push({ name: 'books' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const getBook = async (id) => {
        let response = await axios.get(`/books/${id}`, {
            headers: {
                'Authorization' : `Bearer ${getToken()}`
            }
        })
        book.value = response.data.data
    }

    const updateBook = async (id) => {
        errors.value = ''
        try {
            await axios.post(`/update-book/${id}`, book.value, {
                headers: {
                    'content-type': 'multipart/form-data',
                    'Authorization' : `Bearer ${getToken()}`
                }
            })
            await router.push({ name: 'books' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destroyBook = async (id) => {
        errors.value = ''
        try {
            await axios.delete(`/books/destroy/${id}`, {
                headers: {
                    'Authorization' : `Bearer ${getToken()}`
                }
            })
            await getBooks();
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    return {
        errors,
        book,
        books,
        search,
        booksLength,
        sorting,
        perPage,
        getBooks,
        storeBook,
        getBook,
        updateBook,
        destroyBook
    }
}