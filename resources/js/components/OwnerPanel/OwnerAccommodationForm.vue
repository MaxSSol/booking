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
                    v-model="accommodation.city"
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
                    v-model="accommodation.categories"
                    :options="categories"
                    :multiple="true"
                    placeholder="Оберіть тип помешкання"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
            </div>
            <div class="mt-2">
                <label for="opportunities" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть можливості для відпочинку
                </label>
                <VueMultiselect
                    v-model="accommodation.opportunities"
                    :options="opportunities"
                    :multiple="true"
                    placeholder="Оберіть можливості для вільного часу"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
            </div>
            <div class="mt-2">
                <label for="stars" class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">
                    Оберіть зірковість
                </label>
                <VueMultiselect
                    v-model="accommodation.star"
                    :options="stars"
                    placeholder="Оберіть зірковість"
                    label="title"
                    track-by="id"
                ></VueMultiselect>
            </div>
            <div class="text-center mt-8">
                <button class="py-2 px-8 text-white bg-blue-900 font-bold"
                        @click="updateAccommodation(accommodation)"
                >
                    Внести зміни
                </button>
            </div>
        </div>
    </section>
    <section class="rent-units flex-grow">
        <div class="container mx-auto px-4 lg:px-0">
            <p class="font-bold text-xl">Кімнати</p>
            <div class="rent-units-items">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Назва кімнати
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Вміщує
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ціна за ніч
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Доступна з
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Дії</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white border-b" v-for="item in accommodation.accommodation_units" :key="item.id">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ item.title }}
                            </th>
                            <td class="px-6 py-4">
                                {{ item.max_count_people }}
                            </td>
                            <td class="px-6 py-4">
                                {{ item.price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ item.date_available_from }}
                            </td>
                            <td class="px-6 py-4 flex justify-around gap-x-4">
                                <router-link :to="{name: 'unit/setting', params: {'id': item.id }}"
                                             class="text-base font-medium text-blue-600 hover:underline">
                                    Редагувати
                                </router-link>
                                <button class="text-base font-medium text-blue-600 hover:underline"
                                        @click="removeAccommodationUnit(accommodation.id, item.id)"
                                >
                                    Видалити
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {useStore} from "vuex";
import {computed, onMounted} from "vue";
import useVuelidate from "@vuelidate/core";
import {required, minValue} from "@vuelidate/validators";
import VueMultiselect from  "vue-multiselect";

export default {
    name: "OwnerAccommodationForm",
    components: {VueMultiselect},
    props: ['id'],
    setup(props) {
        const store = useStore()

        const accommodation = computed(() => store.getters['owner/getAccommodation'])

        const cities = computed(() => store.getters['city/getCities'])
        const stars = computed(() => store.getters['star/getStars'])
        const categories = computed(() => store.getters['category/getCategories'])
        const opportunities = computed(() => store.getters['opportunity/getOpportunities'])
        const rentInfo = computed(() => store.getters['rentInfo/getRentInfo'])

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

        onMounted(() => {
            store.dispatch('owner/fetchOwnerAccommodationById', props.id)
            store.dispatch('city/fetchCities')
            store.dispatch('star/fetchStars')
            store.dispatch('category/fetchCategories')
            store.dispatch('opportunity/fetchOpportunities')
            store.dispatch('rentInfo/fetchRentInfo')
        })

        const updateAccommodation = (accommodation) => {
            accommodation.categories = accommodation.categories.map(c => c.id)
            accommodation.opportunities = accommodation.opportunities.map(o => o.id)
            store.dispatch('owner/updateAccommodation', accommodation)
        }

        const removeAccommodationUnit = (accommodationId, unitId) => {
            store.dispatch('owner/removeAccommodationUnit', {accommodationId, unitId});
            alert('Кімната успішно видалена')
        }

        return {
            v$,
            cities,
            opportunities,
            categories,
            stars,
            accommodation,
            rentInfo,
            updateAccommodation,
            removeAccommodationUnit
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
