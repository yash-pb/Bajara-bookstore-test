import { createWebHistory, createRouter } from "vue-router";
import App from "./App.vue";
import Dashboard from "./pages/Dashboard.vue";
import Users from "./pages/user/Users.vue";
import Books from "./pages/Books.vue";
import Login from "./pages/auth/Login.vue";
import Layout from "./components/Layout.vue";
import Create from "./pages/user/Create.vue";

const prefix = '/admin/vue/';

const routes = [
    {
        path: prefix + 'login',
        name: 'login', 
        component: Login,
        meta: {
            hideForAuth: true
        }
    },
    {
        path: prefix,
        name: 'index', 
        component: Layout,
        children: [
            {
                path: 'dashboard',
                name: 'dashboard', 
                component: Dashboard
            },
            {
                path: 'users',
                name: 'users', 
                component: Users,
                children: [
                    {
                        path: 'create',
                        name: 'create', 
                        component: Create
                    }
                ]
            },
            {
                path: 'books',
                name: 'books', 
                component: Books
            }
        ],
        redirect: {
            name: 'login'
        },
    }   
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

console.log(routes);

export default router;