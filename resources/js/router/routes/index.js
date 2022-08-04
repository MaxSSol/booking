import HomeView from "../../views/HomeView";
import LoginView from "../../views/LoginView";
import RegistrationView from "../../views/RegistrationView";
import ProfileView from "../../views/ProfileView";
import AccommodationView from "../../views/AccommodationView";
import AccommodationUnitView from "../../views/AccommodationUnitsView"
import ReservationView from "../../views/ReservationView";
import UserSettingView from "../../views/UserSettingView";
import RegisterAccommodation from "../../views/RegisterAccommodation";
import OwnerAccommodationView from "../../views/OwnerAccommodationView";
import OwnerAccommodationSettingView from "../../views/OwnerAccommodationSettingView";
import RegisterAccommodationUnitView from "../../views/RegisterAccommodationUnitView";
import AccommodationUnitImageView from "../../views/AccommodationUnitImageView";
import OwnerAccommodationUnitSettingView from "../../views/OwnerAccommodationUnitSettingView";

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
    },
    {
        path: '/user/owner',
        name: 'user/owner',
        component: OwnerAccommodationView,
        meta: { auth: true }
    },
    {
        path: '/user/owner/accommodation/:id',
        name: 'owner/accommodation',
        component: OwnerAccommodationSettingView,
        meta: { auth: true },
        props: true
    },
    {
        path: '/user/owner/accommodation/unit',
        name: 'owner/accommodation/unit',
        component: RegisterAccommodationUnitView,
        meta: { auth: true },
    },
    {
        path: '/user/owner/accommodation/unit/:id/image',
        name: 'owner/accommodation/unit/image',
        component: AccommodationUnitImageView,
        meta: {auth: true},
        props: true
    },
    {
        path: '/user/owner/accommodation/unit/:id',
        name: 'unit/setting',
        component: OwnerAccommodationUnitSettingView,
        props: true,
        meta: {auth:true}

    }

]
