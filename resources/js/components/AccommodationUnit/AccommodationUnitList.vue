<template>
    <div v-for="accommodationUnit in accommodationUnits"
         :key="accommodationUnit.id"
         class="item border p-4 rounded-lg flex flex-col items-center lg:items-start md:flex-row mb-2"
    >
        <accommodation-unit-item :accommodation-unit="accommodationUnit" :days="days">
        </accommodation-unit-item>
    </div>
</template>

<script>
import AccommodationUnitItem from "./AccommodationUnitItem";

export default {
    name: "AccommodationUnitList",
    components: {AccommodationUnitItem},
    props: {
        accommodationUnits: {
            type: Array,
            require: true
        },
        days: {
            type: Number,
            require: true
        }
    }
}
</script>

<style scoped>

</style>
