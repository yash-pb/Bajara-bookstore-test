import { createWebHistory, createRouter } from "vue-router";
import App from "./App.vue";
import Dashboard from "./pages/Dashboard.vue";
import Users from "./pages/user/Users.vue";
import Books from "./pages/book/Books.vue";
import Login from "./pages/auth/Login.vue";
import ForgotPassword from "./pages/auth/ForgotPassword.vue";
import ChangePassword from "./pages/auth/ChangePassword.vue";
import Layout from "./components/Layout.vue";
import UserCreate from "./pages/user/Create.vue";
import UserEdit from "./pages/user/Edit.vue";
import BookCreate from "./pages/book/Create.vue";
import BookEdit from "./pages/book/Edit.vue";
import { useUserStore } from "./stores/user";

const prefix = '/admin/vue/';

const routes = [
    {
        path: prefix + 'login',
        name: 'login', 
        component: Login
    },
    {
        path: prefix + 'forgot-password',
        name: 'forgot.password',
        component: ForgotPassword
    },
    {
        path: prefix + 'change-password',
        name: 'change.password',
        component: ChangePassword
    },
    {
        path: prefix,
        name: 'index', 
        component: Layout,
        meta: {
            requiresAuth: true
        },
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
        ]
    }   
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    // linkActiveClass: "bg-blue-600",
    // linkExactActiveClass: "bg-blue-600"
});

console.log(routes);
// protecting routes
router.beforeEach(async (to, from, next) => {
    const userStore = useUserStore();
    if (to.meta.requiresAuth) {
      const token = userStore.token;
      if (token) {
        if(userStore.user.full_name == undefined) {
            await userStore.fetchUser()
        }
        next();
      } else {
        next({name: 'login'});
      }
    } else {
      next();
    }
  });
  

export default router;