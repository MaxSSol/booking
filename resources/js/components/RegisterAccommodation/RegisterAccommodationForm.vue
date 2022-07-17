<template>
    <section class="registration-form mt-6 px-4 lg:px-0">
        <div class="container mx-auto w-full lg:w-1/3">
            <div class="mt-2">
                <label for="title"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Назва житла
                </label>
                <input type="text"
                       id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.title.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.title.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="description" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Опис помешкання
                </label>
                <textarea id="description"
                          rows="4"
                          class="block p-2.5 w-full text-sm text-gray-900
                              bg-gray-50 rounded-lg border
                              border-gray-300 focus:ring-blue-500
                              focus:border-blue-500"
                          placeholder="Опис..."
                          v-model="v$.description.$model"
                >
                </textarea>
                <p class="text-red-600 text-sm font-bold" v-show="v$.description.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="num_of_floors"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Кількість поверхів
                </label>
                <input type="number"
                       id="num_of_floors"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.number_of_floors.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.number_of_floors.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="num_of_rooms"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Кількість кімнат
                </label>
                <input type="number"
                       id="num_of_rooms"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.number_of_rooms.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.number_of_rooms.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="cities" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть містознаходження
                </label>
                <VueMultiselect
                    v-model="v$.city_id.$model"
                    :options="cities"
                    placeholder="Оберіть містознаходження"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
                <p class="text-red-600 text-sm font-bold" v-show="v$.city_id.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="address"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Адреса
                </label>
                <input type="text"
                       id="address"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.address.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.address.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="categories" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть тип помешкання
                </label>
                <VueMultiselect
                    v-model="v$.category_id.$model"
                    :options="categories"
                    :multiple="true"
                    placeholder="Оберіть тип помешкання"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
                <p class="text-red-600 text-sm font-bold" v-show="v$.category_id.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="opportunities" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть можливості для відпочинку
                </label>
                <VueMultiselect
                    v-model="v$.opportunity_id.$model"
                    :options="opportunities"
                    :multiple="true"
                    placeholder="Оберіть можливості для вільного часу"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
                <p class="text-red-600 text-sm font-bold" v-show="v$.opportunity_id.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="stars" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть зірковість
                </label>
                <VueMultiselect
                    v-model="v$.star_id.$model"
                    :options="stars"
                    placeholder="Оберіть зірковість"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
                <p class="text-red-600 text-sm font-bold" v-show="v$.star_id.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="rent-info" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть шаблон оренди
                </label>
                <VueMultiselect
                    v-model="v$.rent_info_id.$model"
                    :options="rentInfo"
                    placeholder="Оберіть шаблон оренди"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
                <p class="text-red-600 text-sm font-bold" v-show="v$.rent_info_id.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="text-center mt-8">
                <button class="py-2 px-8 text-white bg-blue-900 font-bold" @click="addAccommodation">
                    Додати помешкання
                </button>
            </div>
        </div>
    </section>
</template>

<script>
import {useStore} from "vuex";
import {reactive, computed, onMounted} from "vue";
import useVuelidate from "@vuelidate/core";
import {required, minValue} from "@vuelidate/validators";
import VueMultiselect from  "vue-multiselect";

export default {
    name: "RegisterAccommodationForm",
    components: {VueMultiselect},
    setup() {
        const store = useStore()
        const accommodation = reactive({
            title: '',
            description: '',
            number_of_rooms: 1,
            number_of_floors: 1,
            address: '',
            city_id: '',
            star_id: '',
            opportunity_id: [],
            category_id: [],
            rent_info_id: ''
        })

        const cities = computed(() => store.getters['city/getCities'])
        const stars = computed(() => store.getters['star/getStars'])
        const categories = computed(() => store.getters['category/getCategories'])
        const opportunities = computed(() => store.getters['opportunity/getOpportunities'])
        const rentInfo = computed(() => store.getters['rentInfo/getRentInfo'])


        onMounted(() => {
            store.dispatch('city/fetchCities')
            store.dispatch('star/fetchStars')
            store.dispatch('category/fetchCategories')
            store.dispatch('opportunity/fetchOpportunities')
            store.dispatch('rentInfo/fetchRentInfo')
        })

        const rules = computed(() => {
            return {
                title: {required},
                description: {required},
                number_of_rooms: {required, minValue: minValue(1)},
                number_of_floors: {required, minValue: minValue(1)},
                address: {required},
                category_id: {required},
                city_id: {required},
                star_id: {required},
                opportunity_id: {required},
                rent_info_id: {required}
            }
        })

        const v$ = useVuelidate(rules, accommodation)

        const addAccommodation = () => {
            v$.value.$validate()
            if(v$.value.$errors.length === 0) {
                accommodation.city_id = accommodation.city_id.id
                accommodation.star_id = accommodation.star_id.id
                accommodation.category_id = accommodation.category_id.map((c) => c.id)
                accommodation.opportunity_id = accommodation.opportunity_id.map((o) => o.id)
                store.dispatch('accommodation/addAccommodation', accommodation)
                    .then(() => {
                        store.commit('quest/SET_IS_DISABLED_ACCOMMODATION', true)
                        store.commit('quest/SET_IS_DISABLED_ACCOMMODATION_IMAGE', false)
                    })
            }
        }

        return {
            v$,
            cities,
            opportunities,
            categories,
            stars,
            accommodation,
            rentInfo,
            addAccommodation
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
