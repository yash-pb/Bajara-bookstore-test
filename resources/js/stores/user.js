import { defineStore } from "pinia"
import { computed, ref } from 'vue'

export const useUserStore = defineStore("user", () => {
    const user = ref({})
    const token = ref(localStorage.getItem('token') || null)

    const setToken = async(newToken) => {
        token.value = newToken;
    };

    const fetchUser = async () => {
        await axios.get(`fetch-user`, {
            headers: {
                'Authorization' : `Bearer ${token.value}`
            }
        })
        .then(response => {
            user.value = response.data.data ?? [];
        })
        .catch(err => {
            console.log('err from store => '. err);
        });
    };

    return {
        token,
        user,
        setToken,
        fetchUser
    }
})