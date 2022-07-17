export default {
    namespaced: true,
    state: {
        cities: [],
        fetchErr: false
    },
    getters: {
        getCities: state => state.cities
    },
    mutations: {
        SET_CITIES(state, cities) {
            state.cities = cities
        },

        SET_ERR_FETCH(state, status) {
            state.fetchErr = status
        }
    },
    actions: {
        fetchCities({ commit }) {
            axios.get('/api/cities')
                .then(res => commit('SET_CITIES', res.data.cities))
                .catch(() => commit('SET_ERR_FETCH', true))
        }
    }
}
