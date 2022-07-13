<template>
    <div class="room-main-info flex flex-col items-center">
        <reservation-accommodation-item v-for="accommodationUnit in accommodationUnits"
                                 :key="accommodationUnit.id"
                                 :accommodation-unit="accommodationUnit"
        />
    </div>
</template>

<script>
import ReservationAccommodationItem from "./ReservationAccommodationItem";

export default {
    name: "ReservationAccommodationList",
    components: {ReservationAccommodationItem},
    props: {
        accommodationUnits: {
            type: Array,
            require: true
        }
    }
}
</script>

<style scoped>

</style>
