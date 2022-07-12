<template>
    <section class="flex-grow" v-if="!isLoaded">
        <p class="font-bold text-3xl text-center">
            Завантаження...
        </p>
    </section>
    <section v-else>
        <p class="text-base py-2 px-6
       bg-blue-900 text-white cursor-pointer
       w-[200px] lg:hidden"
           @click="showFiltersMenu"
        >
            Показати фільтри
        </p>
        <div class="search flex flex-col lg:flex-row">
            <div :class="{hidden: hiddenFiltersMenu}"
                 class="filter-list flex  flex-col lg:flex-row container mx-auto lg:block mr-2 w-full lg:w-1/3">
                <div class="border divide-y w-full px-2">
                    <p class="text-xl">Популярні фільтри</p>
                    <ul>
                        <li v-for="filterValue in popularCategories" :key="filterValue.id"
                            class="flex"
                        >
                            <filter-checkbox
                                :name="filterValue.id"
                                :title="filterValue.title"
                                :value="filterValue.id"
                                v-model="searchParams.category_id"
                            >
                            </filter-checkbox>
                            <p>({{ filterValue.accommodations_count }})</p>
                        </li>
                        <li v-for="filterValue in popularFacilities" :key="filterValue.id"
                            class="flex"
                        >
                            <filter-checkbox
                                :name="filterValue.id"
                                :title="filterValue.title"
                                :value="filterValue.id"
                                v-model="searchParams.category_id"
                            ></filter-checkbox>
                            <p>({{ filterValue.accommodation_units_count }})</p>
                        </li>
                    </ul>
                </div>
                <div class="border divide-y w-full px-2">
                    <p class="text-xl">Тип помешкання</p>
                    <ul>
                        <li v-for="filterValue in categories" :key="filterValue.id"
                            class="flex"
                        >
                            <filter-checkbox
                                :name="filterValue.id"
                                :title="filterValue.title"
                                :value="filterValue.id"
                                v-model="searchParams.category_id"
                            ></filter-checkbox>
                            <p>({{ filterValue.accommodations_count }})</p>
                        </li>
                    </ul>
                </div>
                <div class="border divide-y w-full px-2">
                    <p class="text-xl">Кількість зірок</p>
                    <ul>
                        <li v-for="filterValue in stars" :key="filterValue.id"
                            class="flex"
                        >
                            <filter-checkbox
                                :name="filterValue.id"
                                :title="filterValue.title"
                                :value="filterValue.id"
                                v-model="searchParams.star_id"
                            ></filter-checkbox>
                            <p>({{ filterValue.accommodations_count }})</p>
                        </li>
                    </ul>
                </div>
                <div class="border divide-y w-full px-2">
                    <p class="text-xl">Як провести вільний час</p>
                    <ul>
                        <li v-for="filterValue in opportunities" :key="filterValue.id"
                            class="flex"
                        >
                            <filter-checkbox
                                :name="filterValue.id"
                                :title="filterValue.title"
                                :value="filterValue.id"
                                v-model="searchParams.opportunity_id"
                            ></filter-checkbox>
                            <p>({{ filterValue.accommodations_count }})</p>
                        </li>
                    </ul>
                </div>
                <div class="border divide-y w-full px-2">
                    <p class="text-xl">Зручності</p>
                    <ul>
                        <li v-for="filterValue in facilities" :key="filterValue.id"
                            class="flex"
                        >
                            <filter-checkbox
                                :name="filterValue.id"
                                :title="filterValue.title"
                                :value="filterValue.id"
                                v-model="searchParams.facility_id"
                            ></filter-checkbox>
                            <p>({{ filterValue.accommodation_units_count }})</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="apartments w-full">
                <accommodation-list :accommodations="accommodation"></accommodation-list>
                <paginate
                    v-model="currentPage"
                    :page-count="paginate.last_page"
                    :click-handler="changePage"
                    :prev-text="'<'"
                    :next-text="'>'"
                    :container-class="'flex justify-center items-center gap-x-4'"
                    :page-class="'cursor pointer py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700'"
                >
                </paginate>
            </div>
        </div>
    </section>
</template>

<script>
import {onMounted, ref, reactive, computed, watch} from "vue";
import {useStore} from "vuex";
import router from "../router";
import FilterCheckbox from "../components/UI/FilterCheckbox";
import AccommodationList from "../components/Accommodation/AccommodationList";
import Paginate from "vuejs-paginate-next";

export default {
    name: "AccommodationView",
    components: {AccommodationList, FilterCheckbox, Paginate},
    setup() {
        const store = useStore();

        let hiddenFiltersMenu = ref(true)

        let currentPage = ref(1)
        let searchParams = reactive(store.state.search.search);

        let categories = computed(() => store.getters['category/getCategories']);
        let opportunities = computed(() => store.getters['opportunity/getOpportunities']);
        let facilities = computed(() => store.getters['facility/getFacilities']);
        let paginate = computed(() => store.getters['accommodation/getPaginateParams']);
        let accommodation = computed(() => store.getters['accommodation/getAccommodation']);
        let stars = computed(() => store.getters['star/getStars']);

        let isLoaded = computed(() => store.getters['accommodation/isLoaded'])

        watch(
            () => searchParams,
            () => {
                loadData(searchParams)
            },
            {deep: true}
        )

        const loadData = (value) => {
            store.commit('accommodation/SET_SEARCH_PARAMS', value)
            store.dispatch('accommodation/fetchAccommodation', value)
            store.dispatch('category/fetchCategories', value)
            store.dispatch('facility/fetchFacilities', value)
            store.dispatch('opportunity/fetchOpportunities', value)
            store.dispatch('star/fetchStars', value)
        }

        onMounted(() => {
            if (!store.getters["accommodation/isLoaded"]) {
                if (store.getters["search/activeSearch"]) {
                    let searchParams = JSON.parse(JSON.stringify(store.state.search.search))
                    loadData(searchParams)
                }

                if (!store.getters["search/activeSearch"]) {
                    router.push({name: 'home'})
                }
            }
        });

        const showFiltersMenu = () => {
            hiddenFiltersMenu.value = hiddenFiltersMenu.value !== true;
        }

        const changePage = (page) => {
            searchParams.page = page
            loadData(searchParams)
            window.scrollTo(0, 0)
        }

        let popularCategories = computed(() => store.getters['category/getPopular'])
        let popularFacilities = computed(() => store.getters['facility/getPopular'])

        return {
            categories,
            hiddenFiltersMenu,
            showFiltersMenu,
            searchParams,
            opportunities,
            facilities,
            accommodation,
            changePage,
            paginate,
            currentPage,
            isLoaded,
            stars,
            popularCategories,
            popularFacilities
        }
    }
}
</script>

