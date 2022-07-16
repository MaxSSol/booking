<template>
    <div class="flex-grow">
        <register-payment-method v-if="!isDisabledPayment"/>
        <register-rent-info-form v-if="!isDisabledRentInfo"/>
        <register-accommodation-form v-if="!isDisabledAccommodation"/>
    </div>
</template>

<script>
import RegisterPaymentMethod from "./RegisterPaymentMethod";
import {useStore} from "vuex";
import {computed} from "vue";
import RegisterRentInfoForm from "./RegisterRentInfoForm";
import RegisterAccommodationForm from "./RegisterAccommodationForm";

export default {
    name: "RegisterAccommodation",
    components: {RegisterAccommodationForm, RegisterRentInfoForm, RegisterPaymentMethod},
    setup() {
        const store = useStore()
        const isDisabledPayment = computed(() => store.getters['quest/getIsDisabledPayment'])
        const isDisabledRentInfo = computed(() => store.getters['quest/getIsDisabledRentInfo'])
        const isDisabledAccommodation = computed(() => store.getters['quest/getIsDisabledAccommodation'])

        return {
            isDisabledPayment,
            isDisabledRentInfo,
            isDisabledAccommodation
        }
    }
}
</script>

<style scoped>

</style>
