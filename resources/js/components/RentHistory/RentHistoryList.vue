<template>
    <div v-if="rentHistories.length === 0">
        <p class="text-4xl font-bold">У вас немає бронювань</p>
    </div>
    <div v-else>
        <rent-history-item v-for="(rentHistory, index) in rentHistories"
                           :key="index"
                           :rent-history="rentHistory"
        >
        </rent-history-item>
    </div>
</template>

<script>
import rentHistoryItem from "./RentHistoryItem";
export default {
    name: "RentHistoryList",
    components: { rentHistoryItem },
    props: {
        rentHistories: {
            type: Array,
            require: true
        }
    }
}
</script>

<style scoped>

</style>
