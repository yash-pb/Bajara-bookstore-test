import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'
import router from "./routes";
import VueAxios from 'vue-axios';
import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://127.0.0.1:8000/admin/vue/api/';

createApp(App).use(router, VueAxios, axios).mount('#app');
