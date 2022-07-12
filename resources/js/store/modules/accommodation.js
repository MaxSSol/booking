export default {
    namespaced: true,

    state: {
        accommodation: [],
        searchParams: {
            city: '',
            rent_date_from: '',
            people: '',
            rooms: '',
            category_id: [],
            opportunity_id: [],
            facility_id: []
        },
        error: false,
        paginate: [],
        prices: []
    },
    getters: {
        getAccommodation: state => state.accommodation,
        isLoaded: state => state.accommodation.length > 0,
        getError: state => state.error,
        getSearchParams: state => state.searchParams,
        getPaginateParams: state => state.paginate,
        getPrices: state => state.prices
    },
    mutations: {
        SET_ACCOMMODATION(state, accommodation) {
            state.accommodation = accommodation
        },

        SET_ERROR(state, error) {
            state.error = error
        },

        SET_SEARCH_PARAMS(state, searchParams) {
            state.searchParams = searchParams
        },

        SET_PAGINATE_PARAMS(state, paginate) {
            state.paginate = paginate
        },

        SET_PRICES(state, prices) {
            state.prices = prices
        }

    },
    actions: {
        async fetchAccommodation({commit}, searchParams) {
            axios.get('/api/accommodation', {
                params: searchParams
            })
                .then(res => {
                    commit('SET_PRICES', {
                        'min_price': res.data.min_price,
                        'max_price': res.data.max_price
                })
                    commit('SET_ACCOMMODATION', res.data.data)
                    commit('SET_PAGINATE_PARAMS', res.data.meta)
                })
                .catch(() => commit('SET_ERROR', true))
        }
    }
}
