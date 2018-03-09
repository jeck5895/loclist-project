export default {
    state : {
        sideBarIsHidden: false
    },
    getters: {
        getSideBarState: state => {
            return state.sideBarIsHidden;
        }
    },
    mutations: {
        setSideBarState: (state, payload) => {
            state.sideBarIsHidden = payload;
        }
    },
    actions: {
        setSideBarState: ({commit}, payload) => {
            commit('setSideBarState', payload);
        }
    }
};