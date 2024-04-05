import { createWebHistory, createRouter } from "vue-router";
import App from "./App.vue";
import Dashboard from "./pages/Dashboard.vue";
import Users from "./pages/Users.vue";
import Books from "./pages/Books.vue";

const prefix = '/admin/vue/';

const routes = [
    {
        path: prefix,
        component: App,
        redirect: {
            name: 'dashboard'
        }
    },
    {
        path: prefix + 'dashboard',
        name: 'dashboard', 
        component: Dashboard,
    },
    {
        path: prefix + 'users',
        name: 'users', 
        component: Users,
    },
    {
        path: prefix + 'books',
        name: 'books', 
        component: Books,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

console.log(routes);

export default router;