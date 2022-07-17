export default {
    namespaced: true,
    state: {
        rentInfo: [],
        fetchErr: false
    },
    getters: {
        getRentInfo: state => state.rentInfo,
        getFetchErr: state => state.fetchErr
    },
    mutations: {
        SET_RENT_INFO(state, rentInfo) {
            state.rentInfo = rentInfo
        },

        SET_FETCH_ERR(state, status) {
            state.fetchErr = status
        },
    },
    actions: {
        fetchRentInfo({ commit }) {
            axios.get('/api/user/rent')
                .then(res => {
                    commit('SET_RENT_INFO', res.data.rent)
                })
                .catch(() => commit('SET_FETCH_ERR', true))
        },

        addRentInfo(_, rentInfo) {
            return new Promise((resolve, reject) => {
                axios.post('/api/user/rent', rentInfo)
                    .then(() => resolve())
                    .catch(() => reject())
            })
        }
    }
}
