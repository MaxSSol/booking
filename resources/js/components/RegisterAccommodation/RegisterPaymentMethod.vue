<template>
    <section class="rent-payment-methods">
        <div class="container mx-auto w-full lg:w-1/3">
            <p class="text-center text-xl">
                Додайте метод оплати
            </p>
            <div class="rent-payment-method">
                <select class="mt-4 bg-gray-50 border border-gray-300
                            text-gray-900 text-sm rounded-lg focus:ring-blue-500
                            focus:border-blue-500 block w-full p-2.5"
                        v-model="paymentMethodId"
                >
                    <option selected disabled value="1">Оберіть метод оплати</option>
                    <option v-for="paymentMethod in paymentMethods" :key="paymentMethod.id"
                            :value="paymentMethod.id"
                    >
                        {{ paymentMethod.title }}
                    </option>
                </select>
            </div>
            <div class="flex justify-center mt-4">
                <button class="font-bold text-white py-2 px-8 bg-blue-900 hover:opacity-50"
                        @click="addPaymentMethod"
                >
                    Додати метод оплати
                </button>
            </div>
        </div>
    </section>
</template>

<script>
import {useStore} from "vuex"
import {ref, computed, onMounted} from "vue";

export default {
    name: "RegisterPaymentMethod",
    setup() {
        const store = useStore()

        const paymentMethods = computed(() => store.getters['paymentMethod/getPaymentMethods'])

        onMounted(() => {
            store.dispatch('paymentMethod/fetchPaymentMethods')
        })

        const disabled = ref(false)

        const paymentMethodId = ref(1)

        const addPaymentMethod = () => {
            let paymentData = {
                'payment_method_id': paymentMethodId.value,
                'bill_number': '1111111111'
            }

            store.dispatch('paymentMethod/addUserPaymentMethod', paymentData)
                .then(() => {
                    store.commit('quest/SET_IS_DISABLED_PAYMENT', true)
                    store.commit('quest/SET_IS_DISABLED_RENT_INFO', false)
                })
        }

        return {
            paymentMethods,
            paymentMethodId,
            disabled,
            addPaymentMethod
        }
    }
}
</script>

<style scoped>

</style>
