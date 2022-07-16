import HomeView from "../../views/HomeView";
import LoginView from "../../views/LoginView";
import RegistrationView from "../../views/RegistrationView";
import ProfileView from "../../views/ProfileView";
import AccommodationView from "../../views/AccommodationView";
import AccommodationUnitView from "../../views/AccommodationUnitsView"
import ReservationView from "../../views/ReservationView";
import UserSettingView from "../../views/UserSettingView";
import RegisterAccommodation from "../../views/RegisterAccommodation";

export default [
    {
        path: '/',
        name: 'home',
        component: HomeView,
        meta: {guest: false}
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
        component: ProfileView,
        meta: { auth: true }
    },
    {
        path: '/accommodation',
        name: 'accommodation',
        component: AccommodationView,
        meta: {guest: false}
    },
    {
        path: '/accommodation/:id',
        name: 'accommodation-unit',
        component: AccommodationUnitView,
        props: true,
        meta: {guest: false}
    },
    {
        path: '/reservation',
        name: 'reservation',
        component: ReservationView,
        meta: { auth: true }
    },
    {
        path: '/user/settings',
        name: 'user/settings',
        component: UserSettingView,
        meta: {auth: true}
    },
    {
        path: '/user/accommodation',
        name: 'user/accommodation',
        component: RegisterAccommodation,
        meta: {auth: true}
    }
]
