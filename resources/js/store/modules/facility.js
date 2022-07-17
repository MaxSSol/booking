export default {
    namespaced: true,

    state: {
        facilities: {},
        isLoaded: false
    },

    getters: {
        getFacilities: state => state.facilities,
        getStatusLoaded: state => state.isLoaded,
        getPopular: state => state.facilities.length > 1 ? state.facilities.slice(0,2) : ''
    },

    mutations: {
        SET_FACILITIES(state, facilities) {
            state.facilities = facilities
        },

        SET_ERR_FETCH(state) {
            state.isLoaded = false
        },

        SET_LOADED(state) {
            state.isLoaded = true
        }
    },

    actions: {
        async fetchFacilities({commit}, searchParams) {
            axios.get('/api/facilities', {
                params: searchParams
            })
                .then(res => {
                    console.log(res)
                    commit('SET_FACILITIES', res.data.data)
                    commit('SET_LOADED')
                })
                .catch(() => commit('SET_ERR_FETCH'))
        }
    }
}
