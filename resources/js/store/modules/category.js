export default {
    namespaced: true,

    state: {
        categories: {},
        isLoaded: false
    },

    getters: {
        getCategories: state => state.categories,
        getStatusLoaded: state => state.isLoaded,
        getPopular: state => state.categories.slice(0,2)
    },

    mutations: {
        SET_CATEGORIES(state, categories) {
            state.categories = categories
        },

        SET_ERR_FETCH(state) {
            state.isLoaded = false
        },

        SET_LOADED(state) {
            state.isLoaded = true
        }
    },

    actions: {
        async fetchCategories({commit}, searchParams) {
            axios.get('/api/categories', {
                    params: searchParams
                }
            )
                .then(res => {
                    commit('SET_CATEGORIES', res.data.data)
                    commit('SET_LOADED')
                })
                .catch(() => commit('SET_ERR_FETCH'))
        }
    }
}
