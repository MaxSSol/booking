export default {
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
        error: false
    },
    getters: {
        getAccommodation: state => state.accommodation,
        getError: state => state.error,
        getSearchParams: state => state.searchParams
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
        }

    },
    actions: {
        async fetchAccommodation({commit, state}) {
            axios.get('/api/accommodation', {
                params: state.searchParams
            })
                .then(res => console.log(res.data.data))
                .catch(() => commit('SET_ERROR', true))
        }
    }
}
