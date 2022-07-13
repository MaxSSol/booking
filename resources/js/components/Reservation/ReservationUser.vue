<template>
    <section class="rent-form mt-8 px-2 lg:px-0">
        <div class="container mx-auto w-full lg:w-2/3 rounded-lg border-2 p-4">
            <p class="text-center text-base text-xl">Перевірте ваші дані</p>
            <div class="flex flex-col justify-center items-center mt-4">
                <div class="flex gap-x-4 w-full">
                    <div class="w-full">
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Ім'я</label>
                        <input type="text"
                               id="first_name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm
                               rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               :value="user.first_name"
                               placeholder="Ім'я" disabled>
                    </div>
                    <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Електронна
                            адреса</label>
                        <input type="email" id="email"
                               class="w-full bg-gray-50 border border-gray-300
                           text-gray-900 text-sm rounded-lg focus:ring-blue-500
                           focus:border-blue-500 block w-full p-2.5"
                               :value="user.email"
                               placeholder="email@max.ua" disabled>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { useStore } from "vuex";
import { computed } from "vue";

export default {
    name: "ReservationUser",
    setup() {
        const store = useStore();

        const user = computed(() => store.getters['user/user'])

        return {
            user
        }
    }
}
</script>

<style scoped>

</style>
