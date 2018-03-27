export default {
    state : {
        no_of_calls_made: {},
        no_of_calls_made_is_loading: false
    },
    getters : {
        getNoOfCallsMade: state => {
            return state.no_of_calls_made;
        },
        getNoOfCallsMadeLoadingState: state => {
            return  state.no_of_calls_made_is_loading;
        }
    },
    mutations : {
        clearNoOfCallsMade: state => {
            state.no_of_calls_made = {};
        },
        setNoOfCallsMade: (state, payload) => {
            state.no_of_calls_made = payload.data;
        },
        setNoOfCallsMadeLoadingState: (state, payload) => {
            state.no_of_calls_made_is_loading = payload;
        }
    },
    actions: {
        loadNoOfCallsMade: ({commit}, payload) => {
            commit('clearNoOfCallsMade');
            commit('setNoOfCallsMadeLoadingState', true);

            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    commit('setNoOfCallsMade', response);
                    setTimeout(() => {
                        commit('setNoOfCallsMadeLoadingState', false);
                        resolve(response)
                    }, 1000);
                })
                .catch(error => {
                    commit('setNoOfCallsMadeLoadingState', false);
                    reject(error)
                    console.error(error)
                });
            });
        }
    }
};