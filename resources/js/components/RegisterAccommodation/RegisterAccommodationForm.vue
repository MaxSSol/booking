<template>
    <section class="registration-form mt-6 px-4 lg:px-0">
        <div class="container mx-auto w-full lg:w-1/3">
            <div class="mt-2">
                <label for="title"
                       class="block mb-2 text-base font-medium text-gray-900"
                >
                    Назва помешкання
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
                          placeholder="Побажання..."
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
                <label for="countries_multiple" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Оберіть
                    зручності</label>
                <select multiple id="countries_multiple"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose countries</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <div class="mt-2">
                <label for="countries_multiple" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Оберіть
                    тип помешкання</label>
                <select multiple id="categories"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose countries</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <div class="mt-2">
                <label for="countries_multiple"
                       class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">Оберіть
                    можливості</label>
                <select multiple id="capabilities"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose countries</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <div class="mt-2">
                <label class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-300"
                       for="multiple_files">
                    Оберіть фотографії помешкання
                </label>
                <input class="block w-full text-sm
                text-gray-900 bg-gray-50
                rounded-lg border border-gray-300
                cursor-pointer focus:outline-none"
                       id="multiple_files"
                       type="file"
                       multiple
                >
            </div>
            <div class="mt-2">
                <label for="countries_multiple"
                       class="block mb-2 text-base font-medium text-gray-900 dark:text-gray-400">Оберіть шаблон
                    оренди</label>
                <select multiple id="rent-info"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose countries</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <div class="text-center mt-8">
                <button class="py-2 px-8 text-white bg-blue-900 font-bold">Додати помешкання</button>
            </div>
        </div>
    </section>
</template>

<script>
import {useStore} from "vuex";
import {reactive,computed} from "vue";
import useVuelidate from "@vuelidate/core";
import {required, minValue} from "@vuelidate/validators";

export default {
    name: "RegisterAccommodationForm",
    setup() {
        const store = useStore()

        const accommodation = reactive({
            title: '',
            description: '',
            number_of_rooms: 1,
            number_of_floors: 1,
            address: '',
            city_id: '',
            star_id: ''
        })

        const rules = computed(() => {
            return {
                title: {required},
                description: {required},
                number_of_rooms: {required, minValue: minValue(1)},
                number_of_floors: {required, minValue: minValue(1)},
                address: {required},
                city_id: {required},
                star_id: {required}
            }
        })

        const v$ = useVuelidate(rules, accommodation)

        return {
            v$
        }
    }
}
</script>

<style scoped>

</style>
