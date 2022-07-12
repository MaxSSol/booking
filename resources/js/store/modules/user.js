export default {
    namespaced: true,

    state: {
        user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null,
        loginErr: '',
        registrationErr: '',
    },

    getters: {
        user: state => state.user,
        isUserLoggedIn: state => state.user !== null,
        getLoginError: state => state.loginErr,
        getRegistrationErr: state => state.registrationErr,
    },

    mutations: {
        SET_USER(state, user) {
            state.user = user
        },

        SET_LOGIN_ERR(state, err) {
            state.loginErr = err
        },

        SET_REGISTRATION_ERR(state, err) {
            state.registrationErr = err
        },
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
                        .catch(() => {
                            commit('SET_LOGIN_ERR', true)
                        })
            })
        },

        async registration({ commit }, user) {
            axios.get('/sanctum/csrf-cookie')
                .then(() => {
                    axios.post('/api/registration', user)
                        .then(res => {
                            commit('SET_USER', res.data.user)
                            localStorage.setItem('user', JSON.stringify(res.data.user))
                        })
                        .catch(() => {
                            commit('SET_REGISTRATION_ERR', true)
                        })
                })
        }
    }
}
