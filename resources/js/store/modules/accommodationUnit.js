import axios from "axios";

export default {
    namespaced: true,

    state: {
        accommodationUnits: [],
        error: false,
        isLoaded: false,
        totalRating: 0,
        countComments: 0,
        reservationUnits: [],
        reservationPrice: [],
        reservationSet: true
    },
    getters: {
        getAccommodationUnits: state => state.accommodationUnits,
        isLoaded: state => state.accommodationUnits !== {},
        getError: state => state.error,
        getTotalRating: state => state.totalRating,
        getCountComments: state => state.countComments,
        getReservationUnits: state => state.reservationUnits,
        getReservationPrice: state => state.reservationPrice.reduce((p, i) => p + i, 0)
    },
    mutations: {
        SET_ACCOMMODATION_UNITS(state, accommodationUnits) {
            state.accommodationUnits = accommodationUnits
        },

        SET_ERROR(state, error) {
            state.error = error
        },

        SET_LOADED(state, status) {
            state.isLoaded = status
        },

        SET_TOTAL_RATING(state, totalRating) {
            state.totalRating = totalRating
        },

        SET_COUNT_COMMENTS(state, count) {
            state.countComments = count
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
            console.log(price)
            state.reservationPrice = state.reservationPrice.filter(p => p !== price)
        },

        SET_RESERVATION_STATUS(state, status) {
            state.reservationSet = status
        }
    },
    actions: {
        fetchAccommodationUnits({commit}, id, searchParams) {
            axios.get('/api/accommodation/' + id, {
                params: searchParams
            })
                .then(res => {
                    commit('SET_ACCOMMODATION_UNITS', res.data.data[0])
                    commit('SET_LOADED', true)
                    commit('SET_TOTAL_RATING', res.data.total_rating)
                    commit('SET_COUNT_COMMENTS', res.data.count_comments)
                })
                .catch(() => commit('SET_ERROR', true))
        },

        saveReservation({commit, state}) {
            axios.get('/api/reservation', {
                params: state.reservationUnits
            })
                .then(() => commit('SET_RESERVATION_STATUS', true))
                .catch(() => commit('SET_RESERVATION_STATUS', false))
        }
    }
}
