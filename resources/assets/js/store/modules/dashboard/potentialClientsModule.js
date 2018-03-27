export default {
    state : {
        potentials_clients: {},
        potentials_clients_is_loading: false,
    },
    getters : {
        getPotentialClients: state => {
            return state.potentials_clients;
        },
        getPotentialClientsLoadingState: state => {
            return state.potentials_clients_is_loading;
        }
    },
    mutations : {
        clearPotentialClients: state => {
            state.potentials_clients = {};
        },
        setPotentialClients: (state, payload) => {
            state.potentials_clients = payload.data;
        },
        setPotentialClientsLoadingState: (state, payload) => {
            state.potentials_clients_is_loading = payload;
        }
    },
    actions : {
        loadPotentialClients: ({commit}, payload) => {
            commit('clearPotentialClients');
            commit('setPotentialClientsLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    commit('setPotentialClients', response);
                    setTimeout(() => {
                        commit('setPotentialClientsLoadingState', false);
                        resolve(response)
                    }, 1000);
                }) 
                .catch(error => {
                    commit('setPotentialClientsLoadingState', false);
                    reject(error);
                    console.log(error)
                })
            })
        }
    }
};