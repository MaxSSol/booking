import axios from "axios";

export default {
    namespaced: true,

    state: {
        accommodationUnits: [],
        accommodationUnit: [],
        error: false,
        isLoaded: false,
        totalRating: 0,
        countComments: 0,
    },
    getters: {
        getAccommodationUnits: state => state.accommodationUnits,
        isLoaded: state => state.accommodationUnits !== {},
        getError: state => state.error,
        getTotalRating: state => state.totalRating,
        getCountComments: state => state.countComments,
        getAccommodationUnit: state => state.accommodationUnit,
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

        SET_ACCOMMODATION_UNIT(state, accommodationUnit) {
            state.accommodationUnit = accommodationUnit
        },

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

        fetchAccommodationUnitById({commit}, id) {
            axios.get('/api/user/units/' + id)
                .then(res => commit('SET_ACCOMMODATION_UNIT', res.data.accommodationUnit))
                .catch(() => commit('SET_ERROR', true))
        },

        updateAccommodationUnit({dispatch}, accommodationUnit) {
            axios.patch('/api/user/units/'  + accommodationUnit.id, accommodationUnit)
                .then(() => dispatch('fetchAccommodationUnitById', accommodationUnit.id))
        }
    }
}
