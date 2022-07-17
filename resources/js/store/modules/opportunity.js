export default {
    namespaced: true,

    state: {
        opportunities: [],
        isLoaded: false
    },

    getters: {
        getOpportunities: state => state.opportunities,
        getStatusLoaded: state => state.isLoaded,
        getPopular: state => state.opportunities.slice(0, 2)
    },

    mutations: {
        SET_OPPORTUNITIES(state, opportunities) {
            state.opportunities = opportunities
        },

        SET_ERR_FETCH(state) {
            state.isLoaded = false
        },

        SET_LOADED(state) {
            state.isLoaded = true
        }
    },

    actions: {
        async fetchOpportunities({commit}, searchParams) {
            axios.get('/api/opportunities',
                {
                    params: searchParams
                })
                .then(res => {
                    commit('SET_OPPORTUNITIES', res.data.data)
                    commit('SET_LOADED')
                })
                .catch(() => commit('SET_ERR_FETCH'))
        }
    }
}
