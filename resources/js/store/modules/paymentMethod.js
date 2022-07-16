export default {
    namespaced: true,
    state: {
        paymentMethods: [],
        fetchErr: false,
    },
    getters: {
        getPaymentMethods: state => state.paymentMethods,
        getFetchErr: state => state.fetchErr,
    },
    mutations: {
        SET_PAYMENT_METHODS(state, paymentMethods) {
            state.paymentMethods = paymentMethods
        },

        SET_ERR_FETCH(state, error) {
            state.fetchErr = error
        },
    },
    actions: {
        fetchPaymentMethods({ commit }) {
            axios.get('/api/payment/methods')
                .then(res => commit('SET_PAYMENT_METHODS', res.data.paymentMethods))
                .catch(() => commit('SET_ERR_FETCH', true))
        },

        addUserPaymentMethod({ commit }, paymentMethod) {
            return new Promise((resolve, reject) => {
                axios.post('/api/user/payment/methods', paymentMethod)
                    .then(() => resolve())
                    .catch(() => reject())
            })
        }
    },
}
