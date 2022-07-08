export default {
    state: {
        user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null,
        err: ''
    },

    getters: {
        user: state => state.user,
        isUserLoggedIn: state => state.user !== null,
        getError: state => state.err
    },

    mutations: {
        SET_USER(state, user) {
            state.user = user
        },

        SET_ERR(state, err) {
            state.err = err
        }
    },

    actions: {
        async login({ commit }, user) {
            axios.get('/sanctum/csrf-cookie')
                .then(() =>  {
                    axios.post('/api/login', user)
                        .then(res => {
                            commit('SET_USER', res.data.user)
                            localStorage.setItem('user', JSON.stringify(res.data.user))
                        })
                        .catch(err => {
                            commit('SET_ERR', err.response.data.error)
                        })
            })
        }
    }
}
