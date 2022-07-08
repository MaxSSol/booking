import LoginView from "../../views/LoginView";
import HomeView from "../../views/HomeView";

import middleware from "../middleware";

export default [
    {
        path: '/login',
        name: 'login',
        component: LoginView,
        beforeEnter: middleware.guest
    },
    {
        path: '/',
        name: 'home',
        component: HomeView,
        beforeEnter: middleware.user
    }
]
