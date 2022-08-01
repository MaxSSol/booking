<template>
    <section class="hero mt-10">
        <div class="container mx-auto px-4 lg:px-0">
            <p class="text-xl md:text-2xl lg:text-4xl">Запити на бронювання</p>
        </div>
    </section>
    <section class="rent-request mt-2">
        <div class="container mx-auto px-4 lg:px-0">
            <div class="relative overflow-x-auto shadow-md mt-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            Назва помешкання
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Тип оплати
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ціна за ніч/Разом
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Дата заїзду
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Дата виїзду
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Контактна інформація
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Дії</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <rent-request-list :rent-histories="rentHistories"/>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script>
import RentRequestList from "./RentRequestList";
import RentHistoryList from "../RentHistory/RentHistoryList";
import {useStore} from "vuex";
import {computed, onMounted} from "vue";

export default {
    name: "RentRequest",
    components: {RentRequestList, RentHistoryList},
    setup() {
        const store = useStore()

        onMounted(() => {
            store.dispatch('owner/fetchRentHistories')
        })

        const rentHistories = computed(() => store.getters['owner/getRentHistories'])

        return {
            rentHistories
        }
    }
}
</script>

<style scoped>

</style>
