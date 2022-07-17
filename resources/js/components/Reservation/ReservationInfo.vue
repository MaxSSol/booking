<template>
    <section class="rent-info mt-4">
        <div class="container mx-auto px-4 lg:px-0 w-full lg:w-2/3">
            <p class="text-xl">Інформація про бронювання</p>
            <div class="w-full mt-2">
                <label for="count_people" class="block mb-2 text-sm font-medium text-gray-900">Кількість людей</label>
                <input type="number" id="count_people"
                       class="w-full bg-gray-50 border border-gray-300
                           text-gray-900 text-sm rounded-lg focus:ring-blue-500
                           focus:border-blue-500 block w-full p-2.5"
                       :value="search.people"
                       disabled
                       >
            </div>
            <div class="w-full mt-2 flex gap-x-2">
                <div class="w-1/2">
                    <label for="date-from" class="block mb-2 text-sm font-medium text-gray-900">Дата заїзду</label>
                    <input type="text" id="date-from"
                           class="w-full bg-gray-50 border border-gray-300
                           text-gray-900 text-sm rounded-lg focus:ring-blue-500
                           focus:border-blue-500 block w-full p-2.5"
                           :value="rentFrom"
                           disabled
                           >
                </div>
                <div class="w-1/2">
                    <label for="date-to" class="block mb-2 text-sm font-medium text-gray-900">Дата виїзду</label>
                    <input type="text" id="date-to"
                           class="w-full bg-gray-50 border border-gray-300
                           text-gray-900 text-sm rounded-lg focus:ring-blue-500
                           focus:border-blue-500 block w-full p-2.5"
                           :value="rentTo"
                           disabled
                           placeholder="2">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {useStore} from "vuex";
import transformDateToUser from "../../helpers/tramsformDateToUser";

export default {
    name: "ReservationInfo",
    setup() {
        const store = useStore()

        let search = store.state.search.search

        const rentFrom = transformDateToUser(search.rent_date_from)
        const rentTo = transformDateToUser(search.rent_date_to)

        return {
            search,
            rentFrom,
            rentTo
        }
    }
}
</script>

<style scoped>

</style>
