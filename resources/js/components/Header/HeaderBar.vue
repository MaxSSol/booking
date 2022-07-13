<template>
    <header class="container mx-auto py-4">
        <nav class="flex flex-wrap items-center
          justify-between w-full
          lg:py-0 px-4 lg:px-0 text-lg"
        >
            <div class="logo">
                <router-link :to="{name: 'home'}" class="text-3xl font-bold text">Booking.com.ua</router-link>
            </div>

            <svg
                xmlns="http://www.w3.org/2000/svg"
                id="menu-button"
                @click="showMenu"
                class="h-6 w-6 cursor-pointer lg:hidden block"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>

            <div :class="{hidden: hiddenMenu}"
                 class="w-full lg:flex lg:items-center lg:w-auto" id="menu">
                <ul class="pt-4 text-base text-gray-700
                    lg:flex lg:justify-between lg:pt-0"
                >
                    <li>
                        <router-link :to="{name: 'home'}"
                                     class="mr-0 lg:mr-2 block hover:text-blue-700
                                     text-base lg:text-xl border-b-2
                                     lg:border-b-0 py-2 lg:py-0"
                        >
                            Головна
                        </router-link>
                    </li>
                    <li>
                        <a class="mr-0 lg:mr-2 block hover:text-blue-700
                            text-base lg:text-xl border-b-2 lg:border-b-0 py-2 lg:py-0"
                           href="#"
                        >
                            Обрати помешкання</a>
                    </li>
                    <li v-if="!isUserLoggedIn">
                        <router-link :to="{name: 'registration'}"
                            class="mr-0 lg:mr-2 block
                            hover:text-blue-700 text-base lg:text-xl
                            border-b-2 lg:border-b-0 py-2 lg:py-0"
                        >
                            Зареєструватися
                        </router-link>
                    </li>
                    <li v-if="!isUserLoggedIn">
                        <router-link :to="{name: 'login'}"
                                     class="block hover:text-blue-700
                                     text-base lg:text-xl py-2 lg:py-0"
                        >
                            Увійти
                        </router-link>
                    </li>
                    <li v-if="isUserLoggedIn">
                        <a href="#"
                                     class="block hover:text-blue-700 lg:mr-2
                                     text-base lg:text-xl py-2 lg:py-0 border-b-2
                                     lg:border-b-0"
                        >
                            {{ user.first_name }}
                        </a>
                    </li>
                    <li v-if="isUserLoggedIn">
                        <button @click="logout"
                                class="block hover:text-blue-700
                                text-base lg:text-xl py-2 lg:py-0"
                        >
                            Вийти
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
import { ref, computed } from "vue";
import {useStore} from "vuex";
import router from "../../router";

export default {
    name: "HeaderBar",
    setup() {
        const store = useStore();
        let hiddenMenu = ref(true)

        const isUserLoggedIn = computed(() => store.getters['user/isUserLoggedIn'])
        const user = computed(() => store.getters['user/user'])

        const showMenu = () => {
            hiddenMenu.value = hiddenMenu.value !== true;
        }

        const logout = () => {
            axios.post('/api/logout', {_method: 'DELETE'})
                .then(() => {
                    localStorage.removeItem('user')
                    window.location.reload()
                    router.push('/')
                })
        }

        return {
            hiddenMenu,
            showMenu,
            isUserLoggedIn,
            user,
            logout
        }
    }
}
</script>

<style scoped>

</style>
