

import { createStore } from 'vuex'

export const store = createStore({
    state: {
        login: true, // Example state variable
    },
    mutations: {
        toggleLogin(state,loginState) {
            console.log()
            state.login = loginState;
        },

    },
    actions: {
        toggleLogin(context, loginState) {
            console.log(loginState);
           context.commit('toggleLogin', loginState);
        },
    },
    getters: {
        getLogin: state => state.login
    }
});