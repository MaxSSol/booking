export default {
    namespaced: true,
    state: {
        isDisabledPayment: false,
        isDisabledRentInfo: true,
        isDisabledAccommodation: true,
        isDisabledAccommodationImage: true
    },
    getters: {
        getIsDisabledPayment: state => state.isDisabledPayment,
        getIsDisabledAccommodation: state => state.isDisabledAccommodation,
        getIsDisabledRentInfo: state => state.isDisabledRentInfo,
        getIsDisabledAccommodationImage: state => state.isDisabledAccommodationImage,
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

        SET_IS_DISABLED_ACCOMMODATION_IMAGE(state, status) {
            state.isDisabledAccommodationImage = status
        }
    }
}
