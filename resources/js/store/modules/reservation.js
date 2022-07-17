import axios from "axios";

export default {
    namespaced: true,

    state: {
        paymentMethods: [],
        fetchErr: false,
        accommodationUnits: [],
        totalPrice: [],
        isReservationSuccess: false,
        reservationUnits: [],
        reservationPrice: [],
    },

    getters: {
        getPaymentMethods: state => state.paymentMethods,
        getFetchErr: state => state.fetchErr,
        getAccommodationUnits: state => state.accommodationUnits,
        getTotalPrice: state => state.totalPrice.reduce((p, i) => p + i, 0),
        getReservationStatus: state => state.isReservationSuccess,
        getReservationUnits: state => state.reservationUnits,
        getReservationPrice: state => state.reservationPrice.reduce((p, i) => p + i, 0)
    },

    mutations: {
        SET_PAYMENT_METHODS(state, paymentMethods) {
            state.paymentMethods = paymentMethods
        },

        SET_ERR_FETCH(state, err) {
            state.fetchErr = err
        },

        SET_ACCOMMODATION_UNITS(state, accommodationUnits) {
            state.accommodationUnits = accommodationUnits
        },

        SET_TOTAL_PRICE(state, totalPrice) {
            state.totalPrice.push(totalPrice)
        },

        REMOVE_TOTAL_PRICE(state, totalPrice) {
            state.totalPrice = state.totalPrice.filter(p => p !== totalPrice)
        },

        SET_IS_RESERVATION_SUCCESS(state, status) {
            state.isReservationSuccess = status
        },

        SET_RESERVATION_UNIT(state, accommodationUnitId) {
            state.reservationUnits.push(accommodationUnitId)
        },

        REMOVE_RESERVATION_UNIT(state, accommodationUnitId) {
            state.reservationUnits = state.reservationUnits.filter(u => u !== accommodationUnitId)
        },

        SET_RESERVATION_PRICE(state, price) {
            state.reservationPrice.push(price)
        },

        REMOVE_RESERVATION_PRICE(state, price) {
            state.reservationPrice = state.reservationPrice.filter(p => p !== price)
        }
    },

    actions: {
        fetchAccommodationPaymentMethods({commit}, id) {
            axios.get('/api/payment', {
                params: {'id': id}
            })
                .then(res => commit('SET_PAYMENT_METHODS', res.data))
                .catch(() => commit('SET_ERR_FETCH', true))
        },

        fetchAccommodationUnitsByIds({commit}, ids) {
            axios.get('/api/units', {
                params: {ids: ids}
            })
                .then(res => commit('SET_ACCOMMODATION_UNITS', res.data.data))
                .catch(() => commit('SET_ERR_FETCH', true))
        },

        addReservation({commit}, reservationData) {
            return new Promise((resolve, reject) => {
                axios.post('/api/reservations', reservationData)
                    .then(res => {
                            commit('SET_IS_RESERVATION_SUCCESS', true)
                            resolve(res)
                        }
                    )
                    .catch(err => {
                        commit('SET_IS_RESERVATION_SUCCESS', false)
                        reject(err)
                    })
            })
        }
    }
}

