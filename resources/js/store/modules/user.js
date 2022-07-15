export default {
    namespaced: true,

    state: {
        user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null,
        loginErr: '',
        registrationErr: '',
        fetchErr: false,
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

        SET_ERR_FETCH(state, status) {
            state.fetchErr = status
        }
    },

    actions: {
        async fetchUser({commit}) {
            axios.get('/api/users')
                .then(res => {
                    localStorage.setItem('user', JSON.stringify(res.data.user))
                    commit('SET_USER', res.data.user)
                })
        },
        async login({commit}, user) {
            await axios.get('/sanctum/csrf-cookie')
            return new Promise((resolve, reject) => {
                axios.post('/api/login', user)
                    .then(res => {
                        commit('SET_USER', res.data.user)
                        localStorage.setItem('user', JSON.stringify(res.data.user))
                        resolve(res)
                    })
                    .catch((error) => {
                        commit('SET_LOGIN_ERR', true)
                        reject(error)
                    })
            })
        },

        async registration({commit}, user) {
            await axios.get('/sanctum/csrf-cookie')
            return new Promise((resolve, reject) => {
                axios.post('/api/registration', user)
                    .then(res => {
                        commit('SET_USER', res.data.user)
                        localStorage.setItem('user', JSON.stringify(res.data.user))
                        resolve(res)
                    })
                    .catch((error) => {
                        commit('SET_REGISTRATION_ERR', true)
                        reject(error)
                    })
            })
        },

        updateUserInformation({ state, commit }, userData) {
            axios.put('/api/users/' + state.user.id, userData, {
                header: {
                    "Content-Type": "multipart/form-data",
                }
            })
                .then(res => {
                    commit('SET_USER', res.data.user)
                    localStorage.setItem('user', JSON.stringify(res.data.user))
                })
                .catch(() => commit('SET_ERR_FETCH', true))
        }
    }
}
