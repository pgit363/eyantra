import { createWebHashHistory, createRouter } from "vue-router";

import HelloWorld from './components/Welcome'
import Yrc from './pages/yrc'
import Users from './pages/users'
// import Home from './pages/Home.vue';
// import Login from "./pages/Login.vue";

const routes = [
    {
        path : '/registrationform',
        name : 'Yrc',
        component: Yrc
    },
    {
        path : '/users',
        name : 'Users',
        component: Users
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router;