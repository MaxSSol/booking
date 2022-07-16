<template>
    <div class="flex-grow">
        <register-payment-method v-if="!isDisabledPayment"/>
        <register-rent-info-form v-if="!isDisabledRentInfo"/>
    </div>
</template>

<script>
import RegisterPaymentMethod from "./RegisterPaymentMethod";
import {useStore} from "vuex";
import {computed} from "vue";
import RegisterRentInfoForm from "./RegisterRentInfoForm";

export default {
    name: "RegisterAccommodation",
    components: {RegisterRentInfoForm, RegisterPaymentMethod},
    setup() {
        const store = useStore()
        const isDisabledPayment = computed(() => store.getters['quest/getIsDisabledPayment'])
        const isDisabledRentInfo = computed(() => store.getters['quest/getIsDisabledRentInfo'])

        return {
            isDisabledPayment,
            isDisabledRentInfo
        }
    }
}
</script>

<style scoped>

</style>
