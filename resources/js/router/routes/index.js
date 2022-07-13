import HomeView from "../../views/HomeView";
import LoginView from "../../views/LoginView";
import RegistrationView from "../../views/RegistrationView";
import Profile from "../../components/Auth/Profile"; //TODO: Change to ProfileView
import AccommodationView from "../../views/AccommodationView";
import AccommodationUnitView from "../../views/AccommodationUnitsView"
import ReservationView from "../../views/ReservationView";

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
    },
    {
        path: '/accommodation',
        name: 'accommodation',
        component: AccommodationView,
    },
    {
        path: '/accommodation/:id',
        name: 'accommodation-unit',
        component: AccommodationUnitView,
        props: true,
    },
    {
        path: '/reservation',
        name: 'reservation',
        component: ReservationView,
        meta: { auth: true }
    }
]
