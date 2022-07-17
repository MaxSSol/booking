import axios from "axios";

export default {
    namespaced: true,

    state: {
        accommodationUnits: [],
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
        }
    }
}
