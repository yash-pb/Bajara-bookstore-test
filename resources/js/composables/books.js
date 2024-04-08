import { ref } from 'vue'
import { useRouter } from 'vue-router'

export default function useBooks() {
    const book = ref([])
    const books = ref([])
    let search = '';
 
    const errors = ref('')
    const router = useRouter()

    const getToken = () => {
        return localStorage.getItem('token');
    }

    const getBooks = async (event = null) => {
        if(event)
            search = event.target.value;

        let response = await axios.get('books', {
            headers: {
                'Authorization' : `Bearer ${getToken()}`
            },
            params: {
                'search': search
            }
        })
        books.value = response.data.data;
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
        getBooks,
        storeBook,
        getBook,
        updateBook,
        destroyBook
    }
}