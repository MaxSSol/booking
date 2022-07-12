<template>
    <div v-for="accommodation in accommodations"
         :key="accommodation.id"
         class="item border p-4 rounded-lg flex flex-col items-center lg:items-start md:flex-row mb-2"
    >
        <accommodation-item :accommodation="accommodation"></accommodation-item>
    </div>
</template>

<script>
import AccommodationItem from "./AccommodationItem";

export default {
    name: "AccommodationList",
    components: {AccommodationItem},
    props: {
        accommodations: {
            require: true
        }
    }
}
</script>

<style scoped>

</style>
