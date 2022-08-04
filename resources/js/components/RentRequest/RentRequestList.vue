<template>
    <tr class="bg-white border-b text-center"
        v-for="rentHistory in rentHistories"
        :key="rentHistory.id"
    >
        <rent-request-item :rent-history="rentHistory"/>
    </tr>
</template>

<script>
import RentRequestItem from "./RentRequestItem";
export default {
    name: "RentRequestList",
    components: {RentRequestItem},
    props: ['rentHistories']

}
</script>

<style scoped>

</style>
