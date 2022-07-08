import { createRouter, createWebHistory } from 'vue-router'
import routes from "./routes/index";
import store from "../store"

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

router.beforeEach((to) => {
    const statusAuth = store.getters.isUserLoggedIn
    const requireAuth = to.matched.some(record => record.meta.auth)

    if (!statusAuth && requireAuth) {
        return {name: 'login'}
    }

    if (statusAuth && !requireAuth) {
        return { name: 'home' }
    }
})


export default router
