export default {
    namespaced: true,

    state: {
        stars: [],

        isLoaded: false
    },

    getters: {
        getStars: state => state.stars,
        getStatusLoaded: state => state.isLoaded
    },

    mutations: {
        SET_STARS(state, stars) {
            state.stars = stars
        },

        SET_ERR_FETCH(state) {
            state.isLoaded = false
        },

        SET_LOADED(state) {
            state.isLoaded = true
        }
    },

    actions: {
        async fetchStars({commit}, searchParams) {
            axios.get('/api/stars',
                {
                    params: searchParams
                })
                .then(res => {
                    commit('SET_STARS', res.data.data)
                    commit('SET_LOADED')
                })
                .catch(() => commit('SET_ERR_FETCH'))
        }
    }
}
