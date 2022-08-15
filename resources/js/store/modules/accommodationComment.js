export default {
    namespaced: true,

    state: {
        status: false,
        error: false
    },
    getters: {
        getStatus: state => state.status,
        isError: state => state.error,
    },
    mutations: {
        SET_STATUS(state, status) {
            state.status = status
        },

        SET_ERROR(state, error) {
            state.error = error
        }
    },
    actions: {
        addComment({commit}, comment) {
            axios.post('/api/user/comments', comment)
                .then(() => commit('SET_STATUS', true))
                .catch(() => commit('SET_ERROR', true))
        }
    }
}
