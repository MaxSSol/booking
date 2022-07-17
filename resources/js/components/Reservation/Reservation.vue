<template>
    <p class="text-2xl font-bold text-center">Бронювання</p>
    <reservation-accommodation></reservation-accommodation>
    <reservation-form/>
</template>

<script>
import ReservationAccommodation from "./ReservationAccommodation";
import ReservationForm from "./ReservationForm";

export default {
    name: "Reservation",
    components: {ReservationForm, ReservationAccommodation}
}
</script>

<style scoped>

</style>
