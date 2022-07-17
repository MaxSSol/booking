export default {
    namespaced: true,

    state: {
        search: localStorage.getItem('search') ? JSON.parse(localStorage.getItem('search')) : null,
    },
    getters: {
        activeSearch: state => state.search !== null,
        getSearch: state => state.search
    },
    mutations: {
        SET_SEARCH(state, search) {
            state.search = search
        }
    },
}
