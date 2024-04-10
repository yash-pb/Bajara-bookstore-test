import { defineStore } from "pinia";

export const useAuthTokenStore = defineStore("AuthToken", {
  state: () => {
    return {
      token: localStorage.getItem('token') || null,
      user: []
    }
  },
  actions: {
    async setToken(token) {
        this.token = token;
    },
    async fetchUser() {
      await axios.get(`fetch-user`, {
        headers: {
            'Authorization' : `Bearer ${this.token}`
        }
      })
      .then(response => {
          this.user = response.data.data ?? [];
      })
      .catch(err => {
        console.log('err from store => '. err);
      });
    }
  },
});