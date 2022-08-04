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
                <label for="square" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Площа кімнати
                </label>
                <input type="number"
                       id="square"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.square.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.square.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="max_count_people"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Вміщує
                </label>
                <input type="number"
                       id="max_count_people"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.max_count_people.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.max_count_people.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="price" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Ціна за ніч
                </label>
                <input type="number"
                       id="price"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.price.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.price.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="date_available" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Доступне для бронювання з:
                </label>
                <input type="date"
                       id="date_available"
                       class="bg-gray-50 border border-gray-300 text-gray-900
                                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                block w-full p-2.5"
                       v-model="v$.date_available_from.$model"
                >
                <p class="text-red-600 text-sm font-bold" v-show="v$.date_available_from.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="accommodation" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть готель
                </label>
                <VueMultiselect
                    v-model="v$.accommodation_id.$model"
                    :options="accommodation"
                    placeholder="Оберіть готель"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
                <p class="text-red-600 text-sm font-bold" v-show="v$.accommodation_id.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="rent-info" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть шаблон бронювання
                </label>
                <VueMultiselect
                    v-model="v$.rent_info_id.$model"
                    :options="rentInfo"
                    placeholder="Оберіть правила оренди"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
                <p class="text-red-600 text-sm font-bold" v-show="v$.rent_info_id.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="mt-2">
                <label for="rent-info" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть зручності
                </label>
                <VueMultiselect
                    v-model="v$.facility_id.$model"
                    :options="facilities"
                    placeholder="Оберіть зручності"
                    label="title"
                    :multiple="true"
                    track-by="id"
                ></VueMultiselect>
                <p class="text-red-600 text-sm font-bold" v-show="v$.facility_id.$error">
                    Обов'язкове для заповнення.
                </p>
            </div>
            <div class="text-center mt-8">
                <button class="py-2 px-8 text-white bg-blue-900 font-bold" @click="addUnit">
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
import VueMultiselect from "vue-multiselect";
import router from "../../router";

export default {
    name: "OwnerAccommodationUnitFrom",
    components: {VueMultiselect},
    setup() {
        const store = useStore()

        const accommodationUnit = reactive({
            title: '',
            description: '',
            number_of_rooms: 1,
            number_of_floors: 1,
            square: '',
            max_count_people: '',
            price: '',
            is_available: true,
            date_available_from: '',
            accommodation_id: '',
            rent_info_id: '',
            facility_id: []
        })


        const facilities = computed(() => store.getters['owner/getFacilities'])
        const accommodation = computed(() => store.getters['owner/getAccommodations'])
        const rentInfo = computed(() => store.getters['rentInfo/getRentInfo'])

        const rules = computed(() => {
            return {
                title: {required},
                description: {required},
                number_of_rooms: {required, minValue: minValue(1)},
                number_of_floors: {required, minValue: minValue(1)},
                square: {required},
                max_count_people: {required},
                price: {required},
                date_available_from: {required},
                accommodation_id: {required},
                rent_info_id: {required},
                facility_id: {required}
            }
        })

        const v$ = useVuelidate(rules, accommodationUnit)

        onMounted(() => {
            store.dispatch('owner/fetchAllFacilities')
            store.dispatch('owner/fetchOwnerAccommodation')
            store.dispatch('rentInfo/fetchRentInfo')
        })

        const addUnit = () => {
            v$.value.$validate()
            if (v$.value.$errors.length === 0) {
                accommodationUnit.rent_info_id = accommodationUnit.rent_info_id.id;
                accommodationUnit.accommodation_id = accommodationUnit.accommodation_id.id
                accommodationUnit.facility_id = accommodationUnit.facility_id.map(f => f.id)
                store.dispatch('owner/addAccommodationUnit', accommodationUnit)
                    .then((res) =>
                        router.push(
                            {
                                name: 'owner/accommodation/unit/image',
                                params: {'id': res.data.accommodationUnit.id}
                            }
                        )
                    )
            }
        }

        return {
            v$,
            facilities,
            accommodation,
            rentInfo,
            accommodationUnit,
            addUnit
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
