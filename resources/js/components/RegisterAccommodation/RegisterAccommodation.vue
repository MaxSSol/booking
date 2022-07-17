<template>
    <div class="flex-grow">
        <register-payment-method v-if="!isDisabledPayment"/>
        <register-rent-info-form v-if="!isDisabledRentInfo"/>
        <register-accommodation-form v-if="!isDisabledAccommodation"/>
        <register-accommodation-image v-if="!isDisabledAccommodationImage"/>
    </div>
</template>

<script>
import RegisterPaymentMethod from "./RegisterPaymentMethod";
import {useStore} from "vuex";
import {computed} from "vue";
import RegisterRentInfoForm from "./RegisterRentInfoForm";
import RegisterAccommodationForm from "./RegisterAccommodationForm";
import RegisterAccommodationImage from "./RegisterAccommodationImage";

export default {
    name: "RegisterAccommodation",
    components: {RegisterAccommodationImage, RegisterAccommodationForm, RegisterRentInfoForm, RegisterPaymentMethod},
    setup() {
        const store = useStore()
        const isDisabledPayment = computed(() => store.getters['quest/getIsDisabledPayment'])
        const isDisabledRentInfo = computed(() => store.getters['quest/getIsDisabledRentInfo'])
        const isDisabledAccommodation = computed(() => store.getters['quest/getIsDisabledAccommodation'])
        const isDisabledAccommodationImage = computed(() => store.getters['quest/getIsDisabledAccommodationImage'])

        return {
            isDisabledPayment,
            isDisabledRentInfo,
            isDisabledAccommodation,
            isDisabledAccommodationImage
        }
    }
}
</script>

<style scoped>

</style>
