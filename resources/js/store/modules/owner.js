export default {
    namespaced: true,
    state: {
        ownerStatus: false,
        accommodation: [],
        accommodations: [],
        facilities: [],
    },
    getters: {
        getOwnerStatus: state => state.ownerStatus,
        getAccommodation: state => state.accommodation,
        getAccommodations: state => state.accommodations,
        getFacilities: state => state.facilities
    },
    mutations: {
        SET_OWNER_STATUS(state, status) {
            state.ownerStatus = status
        },

        SET_ACCOMMODATION(state, accommodation) {
            state.accommodation = accommodation
        },

        SET_ACCOMMODATIONS(state, accommodations) {
            state.accommodations = [...accommodations]
        },
        SET_FACILITIES(state, facilities) {
            state.facilities = facilities
        }
    },
    actions: {
        fetchOwnerStatus({commit}) {
            axios.get('/api/owner/status')
                .then(res => commit('SET_OWNER_STATUS', res.data.status))
                .catch(() => commit('SET_OWNER_STATUS', false))
        },

        fetchOwnerAccommodation({commit}) {
            axios.get('/api/user/accommodation',)
                .then(res => {
                    commit('SET_ACCOMMODATIONS', res.data.accommodation)
                })
        },

        fetchOwnerAccommodationById({commit}, id) {
            axios.get('/api/user/accommodation/' + id)
                .then(res => commit('SET_ACCOMMODATION', res.data.accommodation))
        },

        fetchAllFacilities({commit}) {
            axios.get('/api/unit/facilities')
                .then(res => {
                    commit('SET_FACILITIES', res.data.facilities)
                })
        },

        addAccommodationUnit(_, accommodationData) {
            return new Promise((resolve, reject) => {
                axios.post('/api/user/units', accommodationData)
                    .then((res) => resolve(res))
                    .catch(() => reject())
            })
        },

        fetchAccommodationUnitById({commit}, id) {
            axios.get('/api/user/units/' + id)
                .then(res => commit('SET_ACCOMMODATION', res.data.accommodationUnit))
        },

        addAccommodationUnitImages({state}, images) {
            return new Promise((resolve, reject) => {
                axios.post('/api/accommodation/units/image/upload/' + state.accommodation.id , images, {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                    .then(() => resolve())
                    .catch(() => reject())
            })
        },

        removeAccommodation({dispatch}, id) {
            axios.delete('/api/user/accommodation/' + id)
                .then(() => {
                    dispatch('fetchOwnerAccommodation')
                })
        },

        removeAccommodationUnit({dispatch}, {accommodationId, unitId}) {
            axios.delete('/api/user/units/' + unitId)
                .then(() => dispatch('fetchOwnerAccommodationById', accommodationId))
        },

        updateAccommodation({dispatch}, accommodation) {
            axios.patch('/api/user/accommodation/' + accommodation.id, accommodation)
                .then(() => dispatch('fetchOwnerAccommodationById', accommodation.id))
        }
    }
}
