<template>
    <div class="border w-full
                lg:w-2/3 mt-4 flex flex-col lg:flex-row
                items-center rounded-lg"
    >
        <div class="w-[300px] h-[300px]">
            <accommodation-images :images="accommodationUnit.accommodation_unit_images"/>
        </div>
        <div class="w-full text-center mt-4 lg:mt-0">
            <p class="text-xl">{{ accommodationUnit.title }}</p>
            <p class="text-base pt-4">
                Адреса
                {{ accommodationUnit.accommodation.address }}
                {{accommodationUnit.accommodation.city.title}}
            </p>
            <p class="text-xl font-bold">
                Кількість днів: {{ days }}
                Ціна: {{ totalPrice }}</p>
            <button @click="removeReservation"
                    class="border text-sm px-4
                    py-2 bg-red-700 text-white cursor-pointer
                    lg:text-base lg:px-8 lg:py-2 font-bold
                    lg:text-xl mt-2 lg:mt-6 hover:opacity-50"
            >
                Скасувати бронювання
            </button>
        </div>
    </div>
</template>

<script>
import AccommodationImages from "../Accommodation/AccommodationImages";
import {useStore} from "vuex";
import router from "../../router";
import daysFromDate from "../../helpers/daysFromDate";

export default {
    name: "ReservationAccommodationItem",
    components: {AccommodationImages},
    props: {
        accommodationUnit: {
            type: Object,
            require: true
        }
    },
    setup(props) {
        const store = useStore()

        let search = store.state.search.search
        let days = daysFromDate(search.rent_date_from, search.rent_date_to)

        let totalPrice = props.accommodationUnit.price * days

        store.commit('reservation/SET_TOTAL_PRICE', totalPrice)

        const removeReservation = (id) => {
            let ids = JSON.parse(localStorage.getItem('reservation'))
            if (ids.length > 1) {
                ids = ids.filter(i => i !== id)
                localStorage.setItem('reservation', JSON.stringify(ids))
                store.dispatch('reservation/fetchAccommodationUnitsByIds', ids)
                store.commit('reservation/REMOVE_TOTAL_PRICE', totalPrice)
            }

            if (ids.length === 1) {
                localStorage.removeItem('reservation')
                router.push({name: 'home'})
            }
        }

        return {
            removeReservation,
            totalPrice,
            days
        }
    }
}
</script>

<style scoped>

</style>
