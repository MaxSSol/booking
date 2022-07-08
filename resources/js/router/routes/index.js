import HomeView from "../../views/HomeView";
import LoginView from "../../views/LoginView";

export default [
    {
        path: '/',
        name: 'home',
        component: HomeView,
    },
    {
        path: '/login',
        name: 'login',
        component: LoginView,
    },
]
