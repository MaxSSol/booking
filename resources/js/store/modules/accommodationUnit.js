export default {
    namespaced: true,

    state: {
        accommodationUnits: [],
        error: false,
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
        SET_ACCOMMODATION_UNITS(state, accommodationUnits) {
            state.accommodation = accommodationUnits
        },

        SET_ERROR(state, error) {
            state.error = error
        }

    },
    actions: {
        async fetchAccommodationUnits({commit}, id, searchParams) {
            axios.get('/api/accommodation/' + id, {
                params: searchParams
            })
                .then(res => {
                    console.log(res)
                    commit('SET_ACCOMMODATION_UNITS', res.data.data)
                })
                .catch(() => commit('SET_ERROR', true))
        }
    }
}
