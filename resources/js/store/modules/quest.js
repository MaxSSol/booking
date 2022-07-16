export default {
    namespaced: true,
    state: {
        isDisabledPayment: false,
        isDisabledRentInfo: true,
        isDisabledAccommodation: true
    },
    getters: {
        getIsDisabledPayment: state => state.isDisabledPayment,
        getIsDisabledAccommodation: state => state.isDisabledAccommodation,
        getIsDisabledRentInfo: state => state.isDisabledRentInfo,
    },
    mutations: {
        SET_IS_DISABLED_PAYMENT(state, status) {
            state.isDisabledPayment = status
        },

        SET_IS_DISABLED_ACCOMMODATION(state, status) {
            state.isDisabledAccommodation = status
        },

        SET_IS_DISABLED_RENT_INFO(state, status) {
            state.isDisabledRentInfo = status
        },
    }
}
