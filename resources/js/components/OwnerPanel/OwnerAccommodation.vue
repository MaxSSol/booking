<template>
    <section class="rent-units flex-grow">
        <div class="container mx-auto px-4 lg:px-0">
            <p class="font-bold text-xl">Головне помешкання</p>
            <div class="rent-units-items">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Назва помешкання
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Місто
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Адреса
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Кількість зірок
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Дії</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white border-b" v-for="item in accommodation" :key="item.id">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ item.title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ item.city.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ item.address }}
                            </td>
                            <td class="px-6 py-4">
                                {{ item.star.title }}
                            </td>
                            <td class="px-6 py-4 flex justify-around gap-x-4">
                                <router-link :to="{name: 'owner/accommodation', params: {'id': item.id }}"
                                             class="font-medium text-blue-600 hover:underline">
                                    Редагувати
                                </router-link>
                                <a href="#" class="font-medium text-blue-600 hover:underline">Видалити</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {useStore} from "vuex";
import {computed, onMounted} from "vue";

export default {
    name: "OwnerAccommodation",
    setup() {
        const store = useStore()

        const accommodation = computed(() => store.getters['owner/getAccommodation'])
        onMounted(() => {
            store.dispatch('owner/fetchOwnerAccommodation')
        })

        return {
            accommodation
        }
    }
}
</script>

<style scoped>

</style>
