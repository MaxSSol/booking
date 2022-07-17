<template>
    <reservation-accommodation-list
        :accommodation-units="accommodationUnits"
    >
    </reservation-accommodation-list>
</template>

<script>
import ReservationAccommodationList from "./ReservationAccommodationList";
import {useStore} from "vuex";
import { computed, onMounted } from "vue";
import router from "../../router";

export default {
    name: "ReservationAccommodation",
    components: {ReservationAccommodationList},
    setup() {
        const store = useStore()

        let accommodationUnits = computed(() => store.getters['reservation/getAccommodationUnits'])

        onMounted(() => {
            if (localStorage.getItem('reservation')) {
                let ids = JSON.parse(localStorage.getItem('reservation'));
                store.dispatch('reservation/fetchAccommodationUnitsByIds', ids)
                store.dispatch('reservation/fetchAccommodationPaymentMethods', ids[0])
            }

            if (!localStorage.getItem('reservation')) {
                router.push({name: 'home'})
            }
        })


        return {
            accommodationUnits
        }
    }
}
</script>

<style scoped>

</style>
