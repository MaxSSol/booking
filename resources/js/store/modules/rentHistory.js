export default {
    namespaced: true,

    state: {
        rentHistories: [],
    },

    getters: {
        getRentHistories: state => state.rentHistories,
    },

    mutations: {
        SET_RENT_HISTORIES(state, rentHistories) {
            state.rentHistories = rentHistories
        },
    },

    actions: {
        fetchRentHistories({ commit }) {
            axios.get('/api/user/histories')
                .then(res => commit('SET_RENT_HISTORIES', res.data.data))
        },
    }
}
