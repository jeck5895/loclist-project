export default {
    state : {
        acquired_clients : {},
        acquired_clients_is_loading: false
    },
    getters : {
        getAcquiredClients: state => {
            return state.acquired_clients;
        },
        getAcquiredClientsLoadingState: state => {
            return state.acquired_clients_is_loading;
        }
    },
    mutations : {
        clearAcquiredClients: state => {
            state.acquired_clients = {};
        },
        setAcquiredClients: (state, payload) => {
            state.acquired_clients = payload.data;
        },
        setAcquiredClientsIsLoading: (state, payload) => {
            state.acquired_clients_is_loading = payload ;
        }
    },
    actions : {
        loadAcquiredClients: ({commit}, payload) => {
            commit('clearAcquiredClients');
            commit('setAcquiredClientsIsLoading', true);

            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    commit('setAcquiredClients', response);
                    setTimeout(() => {
                        commit('setAcquiredClientsIsLoading', false);
                        resolve(response);  
                    }, 1000);
                }) 
                .catch(error => {
                    console.error(error);
                    commit('setAcquiredClientsIsLoading', false);
                    reject(error);
                });
            });
        }
    }
}