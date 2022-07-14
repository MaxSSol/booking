<template>
    <div class="photo mx-auto w-[300px] h-[300px] lg:mr-4">
        <accommodation-images :images="accommodationUnit.accommodation_unit_images">
        </accommodation-images>
    </div>
    <div class="item-info gap-6 w-2/3 flex flex-col items-center justify-between">
        <p class="text-center lg:text-start text-xl font-bold">
            {{ accommodationUnit.title }}
        </p>
        <p class="w-full text-justify hidden lg:block">{{ accommodationUnit.description }}</p>
        <p class="text-xl">
            Вміщує:
            {{ accommodationUnit.max_count_people }}
        </p>
        <div>
            <p class="text-xl">Зручності у номері:</p>
            <div class="facilities flex flex-wrap gap-x-6">
                <p class="text-base" v-for="facility in accommodationUnit.facilities" :key="facility.id">
                    {{ facility.title }}</p>
            </div>
        </div>

        <p class="text-xl font-bold">Кількість днів: {{ days }} Ціна:{{ accommodationUnit.price * days }}</p>
        <div class="w-full lg:w-auto text-center">
            <button v-show="!reservation"
                    class="border text-sm px-4
                    py-2 bg-blue-700 text-white cursor-pointer
                    lg:text-base lg:px-8 lg:py-2 font-bold
                    lg:text-xl mt-2 lg:mt-6 hover:opacity-50"
                    @click="addToReservation(accommodationUnit.id, accommodationUnit.price * days)"
            >
                Додати до бронювання
            </button>
            <button v-show="reservation"
                    @click="removeFromReservation(accommodationUnit.id, accommodationUnit.price * days)"
                    class="border text-sm px-4
                    py-2 bg-red-700 text-white cursor-pointer
                    lg:text-base lg:px-8 lg:py-2 font-bold
                    lg:text-xl mt-2 lg:mt-6 hover:opacity-50">
                Видалити з бронювання
            </button>
        </div>
    </div>
</template>

<script>
import AccommodationImages from "../Accommodation/AccommodationImages";
import {useStore} from "vuex";
import {ref} from "vue";

export default {
    name: "AccommodationUnitItem",
    components: {AccommodationImages},
    props: {
        accommodationUnit: {
            type: Object,
            require: true
        },
        days: {
            type: Number,
            require: true
        }
    },
    setup() {
        const store = useStore()
        let reservation = ref(false)
        const addToReservation = (id, price) => {
            store.commit('reservation/SET_RESERVATION_UNIT', id)
            store.commit('reservation/SET_RESERVATION_PRICE', price)
            reservation.value = true
        }

        const removeFromReservation = (id, price) => {
            store.commit('reservation/REMOVE_RESERVATION_UNIT', id)
            store.commit('reservation/REMOVE_RESERVATION_PRICE', price)
            reservation.value = false
        }


        return {
            reservation,
            addToReservation,
            removeFromReservation
        }
    }
}
</script>

<style scoped>

</style>
*9+

