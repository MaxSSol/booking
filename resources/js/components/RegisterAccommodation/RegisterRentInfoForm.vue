<template>
    <section class="rent-info px-4 lg:px-0">
    <div class="container mx-auto w-full lg:w-1/3">
        <p class="text-center text-xl">
            Правила оренди
        </p>
        <p class="text-sm mt-4">Додайте свої правила оренди.</p>
        <div class="rent-info-form">
            <div class="mt-2">
                <label for="min-rent"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Кількість днів для мінімальної оренди (у днях)
                </label>
                <input type="number"
                       id="min-rent"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.rent_for_short_term.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.rent_for_short_term.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="max-rent"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Кількість днів для максимальної оренди (у днях)
                </label>
                <input type="number"
                       id="max-rent"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.rent_for_long_term.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.rent_for_long_term.$error">
                    Обов'язкове для заповнення. Значення від 2 днів
                </p>
            </div>
            <div class="mt-2">
                <div class="mt-2 flex">
                    <select class="mt-4 bg-gray-50 border border-gray-300
                            text-gray-900 text-sm rounded-lg focus:ring-blue-500
                            focus:border-blue-500 block w-full p-2.5"
                            v-model="rentRules.free_termination"
                    >
                        <option selected disabled value="1">Оберіть тип скасування</option>
                        <option :value="true">Скасування безкоштовне</option>
                        <option :value="false">Скасування платне</option>
                    </select>
                </div>
            </div>
            <div class="mt-2" v-show="!rentRules.free_termination">
                <label for="price"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Сума до сплати для скасування контракту
                </label>
                <input type="number"
                       id="price"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.leave_termination_price.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.leave_termination_price.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2 text-center" @click="addRentRule">
                <button class="py-2 px-8 bg-blue-900 text-white">Додати правило оренди</button>
            </div>
        </div>
    </div>
</section>
</template>

<script>
import {useStore} from "vuex";
import { computed, reactive } from "vue"
import useVuelidate from "@vuelidate/core";
import {requiredIf, required, minValue} from "@vuelidate/validators";

export default {
    name: "RegisterRentInfoForm",
    setup() {
        const store = useStore()

        const rentRules = reactive({
            rent_for_short_term: 1,
            rent_for_long_term: 2,
            free_termination: true,
            leave_termination_price: 0
        })

        const rules = computed(() => {
            return {
                rent_for_short_term: {required, minValue: minValue(1)},
                rent_for_long_term: {required, minValue: minValue(2)},
                leave_termination_price: {requiredIf: requiredIf(rentRules.free_termination === false)}
            }
        })

        const v$ = useVuelidate(rules, rentRules)

        const addRentRule = () => {
            v$.value.$validate()
            if(v$.value.$errors.length === 0) {
                store.dispatch('rentInfo/addRentInfo', rentRules)
                    .then(() => {
                        store.commit('quest/SET_IS_DISABLED_RENT_INFO', true)
                        store.commit('quest/SET_IS_DISABLED_ACCOMMODATION', false)
                    })
            }
        }

        return {
            rentRules,
            addRentRule,
            v$
        }

    }
}
</script>

<style scoped>

</style>
