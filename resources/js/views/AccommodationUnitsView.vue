<template>
    <div v-show="isLoaded">
        <accommodation :accommodation="accommodation"
                       :totalRating="totalRating"
                       :countComments="countComments"
                       :days="days"
        ></accommodation>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {onMounted, computed} from "vue";
import router from "../router";
import Accommodation from "../components/Accommodation/Accommodation";
import daysFromDate from "../helpers/daysFromDate";

export default {
    name: "AccommodationUnitsView",
    components: {Accommodation},
    props: {
        id: {
            type: String,
            require: true
        }
    },
    setup(props) {
        let id = props.id

        const store = useStore();

        let accommodation = computed(() => store.getters['accommodationUnit/getAccommodationUnits'])
        let isLoaded = computed(() => store.getters['accommodationUnit/isLoaded'])
        let totalRating = computed(() => store.getters['accommodationUnit/getTotalRating'])
        let countComments = computed(() => store.getters['accommodationUnit/getCountComments'])
        onMounted(() => {
            let searchParams = store.state.search.search


            if (searchParams !== null) {
                store.dispatch(
                    'accommodationUnit/fetchAccommodationUnits',
                    id,
                    searchParams
                )
            }

            if (searchParams === null) {
                alert('Додайте дані для пошуку')
                router.push({name: 'home'})
            }
        })

        let searchParams = store.state.search.search

        let days = daysFromDate(searchParams.rent_date_from, searchParams.rent_date_to)

        return {
            id,
            accommodation,
            isLoaded,
            totalRating,
            countComments,
            days
        }
    }
}
</script>

<style scoped>

</style>
