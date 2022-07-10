<template>
    <section class="rent-search mt-12 px-2">
        <div class="container mx-auto">
            <div class="flex items-center justify-center flex-col lg:flex-row">
                <div class="w-full lg:w-1/3 border-4 border-yellow-400 h-[50px]">
                    <input type="text"
                           class="bg-gray-50 w-full text-gray-900 p-2.5
                   text-sm focus:ring-blue-500 focus:border-blue-500
                   block placeholder:text-gray-900 placeholder:font-bold"
                           placeholder="Куди ви вирушаєте?"
                           v-model="v$.city.$model"
                    >
                </div>
                <div class="w-full lg:w-2/3 flex border-4 border-yellow-400 h-[50px]">
                    <litepie-datepicker v-model="dateValue"
                                        :shortcuts="false"
                                        separator=" - "
                                        :disable-date="dDate"
                                        :formatter="formatter"
                                        i18n="uk"
                                        placeholder="Дата заїзду - Дата виїзду"
                    >
                    </litepie-datepicker>
                </div>
                <div class="relative w-full lg:w-1/2 border-4 border-yellow-400 h-[50px]">
                    <div class="flex items-center justify-around" @click="showSelectMenu">
                        <p class="mx-2 font-bold">{{search.people}} дорослих</p>
                        <p class="mx-2 font-bold">{{search.rooms}} номери</p>
                        <p class="text-2xl cursor-pointer">&#8597;</p>
                    </div>
                    <div :class="{hidden: hiddenSelectMenu}"
                         class="absolute top-[56px] right-0 bg-slate-100 w-auto py-6" id="rent-menu"
                    >
                        <div class="px-4">
                            <div class="flex justify-between items-center mb-2 gap-x-4">
                                <p class="font-bold">
                                    Дорослих
                                </p>
                                <div class="flex items-center gap-x-4">
                                    <button class="border border-blue-300 cursor-pointer px-4 py-2 hover:opacity-50"
                                            @click="changeAdult('-')"
                                    >
                                        -
                                    </button>
                                    <p class="font-medium">{{search.people}}</p>
                                    <button class="border border-blue-300 cursor-pointer px-4 py-2 hover:opacity-50"
                                            @click="changeAdult('+')"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="font-bold">
                                    Номерів
                                </p>
                                <div class="flex items-center gap-x-4">
                                    <button class="border border-blue-300 cursor-pointer px-4 py-2 hover:opacity-50"
                                            @click="changeRooms('-')"
                                    >
                                        -
                                    </button>
                                    <p class="font-medium">{{ search.rooms }}</p>
                                    <button class="border border-blue-300 cursor-pointer px-4 py-2 hover:opacity-50"
                                            @click="changeRooms('+')"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button :disabled="dateValue.rent_date_from === ''"
                        class="disabled:cursor-not-allowed disabled:text-litepie-secondary-500 h-[50px] w-full lg:w-auto
                        bg-blue-700 py-2 px-10 text-white
                        font-bold border-4 border-yellow-400 hover:opacity-50"
                        @click="submitForm"
                >
                    Шукати
                </button>
            </div>
        </div>
    </section>
</template>

<script>
import LitepieDatepicker from 'litepie-datepicker';
import { ref, reactive, computed } from "vue";
import {useStore} from "vuex";
import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import transformDate from "../../helpers/transformDate";
import router from "../../router";

export default {
    name: "SearchForm",
    components: { LitepieDatepicker },
    setup() {
        const store = useStore();

        let search = reactive({
            city: store.getters.getSearch.city !== '' ? store.getters.getSearch.city : '',
            people: 1,
            rooms: 1
        })

        const dateValue = ref({
            rent_date_from: '',
            rent_date_to: ''
        });

        const formatter = ref({
            date: 'DD-MM-YYYY',
            month: 'MMM'
        });

        const rules = computed(() => {
            return {
                city: { required },
            }
        })


        const v$ = useVuelidate(rules, search)

        let hiddenSelectMenu = ref(true);

        const showSelectMenu = () => {
            hiddenSelectMenu.value = hiddenSelectMenu.value !== true;
        }

        const changeAdult = (operation) => {
            if (operation === '-' && search.people  !== 1) {
                search.people -= 1;
            }
            if (operation === '+') search.people += 1;
        }

        const  changeRooms = (operation) => {
            if (operation === '-' && search.rooms !== 1) {
                search.rooms -= 1;
            }
            if (operation === '+') search.rooms += 1;
        }


        const dDate = (date) => {
            return date < new Date() || date > new Date(2030, 0, 8)
        }

        const submitForm = () => {
            let city = search.city
            if (city !== '') {
                search.city = city[0].toUpperCase() + city.slice(1)
            }

            if (dateValue.value.rent_date_from) {
                dateValue.value.rent_date_from = transformDate(dateValue.value.rent_date_from)
                dateValue.value.rent_date_to = transformDate(dateValue.value.rent_date_to)
            }

            v$.value.$validate()

            if (v$.value.$errors.length === 0) {
                let searchParams = {
                    ...search,
                    ...dateValue.value
                }

                localStorage.setItem('search', JSON.stringify(searchParams))
                store.commit('SET_SEARCH', searchParams)

                store.commit('SET_SEARCH_PARAMS', searchParams);
                store.dispatch('fetchAccommodation')

                router.push('/accommodation')
            }
        }

        return {
            dateValue,
            formatter,
            dDate,
            hiddenSelectMenu,
            showSelectMenu,
            search,
            changeAdult,
            changeRooms,
            submitForm,
            v$
        }
    }
}
</script>

<style scoped>

</style>
