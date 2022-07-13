import { createRouter, createWebHistory } from 'vue-router'
import routes from "./routes/index";
import store from "../store"

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

router.beforeEach((to, from, next) => {
    const statusAuth = store.getters['user/isUserLoggedIn']
    const requireAuth = to.matched.some(record => record.meta.auth)
    const requireGuest = to.matched.some(record => record.meta.guest)

    if (!statusAuth && requireAuth) {
        next({name: 'login'})
    }

    if (statusAuth && requireGuest) {
        next({name: 'profile'})
    }

    if ((statusAuth || !statusAuth) && !requireGuest) {
        next()
    }

})


export default router
