<template>
    <rent-history-list :rent-histories="rentHistories"/>
</template>

<script>
import { computed, onMounted } from "vue";
import { useStore } from "vuex";
import RentHistoryList from "./RentHistoryList";

export default {
    name: "RentHistory",
    components: {RentHistoryList},
    setup() {
        const store = useStore()

        let rentHistories = computed(() => store.getters['rentHistory/getRentHistories'])

        onMounted(() => {
            store.dispatch('rentHistory/fetchRentHistories')
        })

        return {
            rentHistories
        }
    }
}
</script>

<style scoped>

</style>
