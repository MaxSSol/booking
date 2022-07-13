<template>
    <div v-show="error">
        <p class="text-4xl">На жаль сталась помилка при бронюванні. Спробуйте пізніше</p>
    </div>
    <div v-show="!error">
        <reservation-user/>
        <reservation-info/>
        <section class="rent-comment mt-4">
            <div class="container mx-auto px-4 lg:px-0 w-full lg:w-2/3">
                <p class="text-xl">Додайте до свого бронювання</p>
                <p class="text-sm">Виконання особливих побажань не гарантовано, однак адміністрація помешкання зробить
                    усе
                    можливе, щоб задовольнити ваші потреби. Ви завжди можете відправити запит або особливе побажання
                    після
                    завершення бронювання!</p>
                <div class="w-full mt-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Побажання
                        (за бажанням)</label>
                    <textarea id="message"
                              rows="4"
                              class="block p-2.5 w-full text-sm text-gray-900
                              bg-gray-50 rounded-lg border
                              border-gray-300 focus:ring-blue-500
                              focus:border-blue-500"
                              placeholder="Побажання..."
                              v-model="comment"
                    >
                </textarea>
                </div>
            </div>
        </section>
        <section class="rent-pricing">
            <div class="container mx-auto w-full lg:w-2/3 px-4 lg:px-0 mt-4">
                <div class="payment-methods">
                    <label for="payment-method"
                           class="block mb-2 text-xl font-medium text-gray-900"
                    >
                        Метод оплати
                    </label>
                    <select id="payment-method"
                            class="bg-gray-50 border border-gray-300
                    text-gray-900 text-sm rounded-lg focus:ring-blue-500
                    focus:border-blue-500 block w-full p-2.5"
                            v-model="payment_method_id"
                    >
                        <option selected disabled value="1">Оберіть метод оплати</option>
                        <option v-for="paymentMethod in paymentMethods"
                                :key="paymentMethod.id"
                                :value="paymentMethod.id"
                        >
                            {{ paymentMethod.title }}
                        </option>

                    </select>
                    <p v-show="paymentRequire" class="text-red-600 text-base">*Оберіть метод оплати</p>
                </div>
                <p class="text-2xl font-bold text-right mt-4">До сплати: {{ totalPrice }}</p>
            </div>
        </section>
        <section class="rent-submit my-16">
            <div class="container mx-auto text-center">
                <button @click="submitReservation"
                        :disabled="loading"
                        class="disabled:cursor-not-allowed disabled:opacity-50 text-xl font-bold py-2 px-8
                    bg-blue-900 text-white hover:opacity-50"
                >Підтвердити бронювання
                </button>
            </div>
        </section>
    </div>
</template>

<script>
import ReservationUser from "./ReservationUser";
import ReservationInfo from "./ReservationInfo";
import {ref, computed} from "vue";
import {useStore} from "vuex";
import router from "../../router";

export default {
    name: "ReservationForm",
    components: {ReservationInfo, ReservationUser},
    setup() {
        let comment = ref('');
        let payment_method_id = ref('')
        let paymentRequire = ref(false)
        let error = ref(false)
        const store = useStore()

        let totalPrice = computed(() => store.getters['reservation/getTotalPrice'])
        let paymentMethods = computed(() => store.getters['reservation/getPaymentMethods'])

        let loading = ref(false)

        const submitReservation = () => {
            let searchData = store.state.search.search
            let reservation = JSON.parse(localStorage.getItem('reservation'))
            let reservationData = {
                'number_of_people': searchData.people,
                'rent_date_from': searchData.rent_date_from,
                'rent_date_to': searchData.rent_date_to,
                'accommodation_unit_id': reservation,
                'comment': comment.value,
                'payment_method_id': payment_method_id.value
            }

            if (payment_method_id.value) {
                loading.value = true
                store.dispatch('reservation/addReservation', reservationData)
                    .then(() => {
                        loading.value = false
                        alert('Бронювання створено. Повідомлення про бронювання відправлено на електронну адресу.')
                        localStorage.removeItem('reservation')
                        router.push({name: 'profile'})
                    })
                    .catch(() => {
                        error.value = true
                    })

            }

            if (!payment_method_id.value) {
                paymentRequire.value = true
            }
        }

        return {
            comment,
            paymentMethods,
            payment_method_id,
            totalPrice,
            submitReservation,
            error,
            paymentRequire,
            loading
        }
    }
}
</script>

<style scoped>

</style>
