import { createWebHistory, createRouter } from "vue-router";
import App from "./App.vue";
import Dashboard from "./pages/Dashboard.vue";
import Users from "./pages/user/Users.vue";
import Books from "./pages/book/Books.vue";
import Login from "./pages/auth/Login.vue";
import Layout from "./components/Layout.vue";
import UserCreate from "./pages/user/Create.vue";
import UserEdit from "./pages/user/Edit.vue";
import BookCreate from "./pages/book/Create.vue";
import BookEdit from "./pages/book/Edit.vue";

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
                component: Users
            },
            {
                path: 'users/create',
                name: 'user.create', 
                component: UserCreate
            },
            {
                path: 'users/edit/:id',
                name: 'user.edit', 
                component: UserEdit,
                props: true
            },
            {
                path: 'books',
                name: 'books', 
                component: Books
            },
            {
                path: 'books/create',
                name: 'book.create', 
                component: BookCreate
            },
            {
                path: 'books/edit/:id',
                name: 'book.edit', 
                component: BookEdit,
                props: true
            },
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

// console.log(routes);

export default router;