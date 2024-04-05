import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'
import router from "./routes";

// App.mount('#app');
// createApp(App).mount('#app')
// console.log(router);
const app = createApp(App);
app.use(router);
app.mount('#app');


