import HomeView from "../../views/HomeView";
import LoginView from "../../views/LoginView";
import RegistrationView from "../../views/RegistrationView";
import Profile from "../../components/Auth/Profile";

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
        meta: {guest: true}
    },
    {
        path: '/registration',
        name: 'registration',
        component: RegistrationView,
        meta: {guest: true}
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile,
        meta: { auth: true }
    }
]
