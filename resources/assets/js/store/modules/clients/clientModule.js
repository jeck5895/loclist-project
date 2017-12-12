
export default {
    state:{
        clients: [],
        client: {},
        client_manpower_providers: [],
        client_manpower_provider: {},
        client_sourcing_practices: [],
        client_sourcing_practice: {}
    },
    getters:{
        getClients: state => {
            return state.clients;
        },
        getClient: state => {
            return state.client;
        },
        getClientManpowerProviders: state => {
            return state.client_manpower_providers;
        },
        getClientManpowerProvider: state => {
            return state.client_manpower_provider;
        },
        getClientSourcingPractices: state => {
            return state.client_sourcing_practices;
        },  
        getClientSourcingPractice: state => {
            return state.client_sourcing_practice;
        }
    },
    mutations:{
        clearClient: state => {
            state.client = {};
        },
        clearClients: state => {
            state.clients = [];
        },
        clearClientManpowerProviders: state => {
            state.client_manpower_providers = [];
        },
        removeClientManpowerProvider: (state, payload) => {
            state.client_manpower_providers.splice(state.client_manpower_providers.indexOf(payload), 1);
        },
        setClients: (state, payload) => {
            state.clients = payload.data;
        },
        setClient: (state, payload) => {
            state.client = payload.data;
        },
        setClientManpowerProviders: (state, payload) => {
            state.client_manpower_providers.push(payload);
        },
        setClientManpowerProvider: (state, payload) => {
            state.client_manpower_provider;
        }
    },
    actions:{
        /* This where asynchronous/ajax calls perform and call mutation methods to assign response to state */
        clearClient: context => {
            context.commit('clearClient');
        },
        clearClients: context => {
            context.commit('clearClients');
        },
        clearClientManpowerProviders: context => {
            context.commit('clearClientManpowerProviders');
        },
        loadClient: (context, payload) => {
            axios.get('api/clients/', + payload.id)
            .then(response => {
                context.commit('setClient', response);
            })
            .catch(error => {
                console.log(error.response);
            });
        },
        loadClients: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setClients', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response.data);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            });
        },
        removeClientManpowerProvider: (context, payload) => {
            context.commit('removeClientManpowerProvider', payload);
        },
        storeClientManpowerProviders: (context, payload) => {
            context.commit('setClientManpowerProviders', payload)
        },
        storeClient: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.post('api/clients', payload)
                .then(response => {
                    context.commit('setServerResponse', response);
                    toastr.success('Success', response.data.message);
                    resolve(response)
                })
                .catch(error => {
                    context.commit('setServerResponse', error.response);
                    reject(error.response)
                });
            })
        },
        updateClient: (context, payload) => {
            axios.patch('api/clients/' + payload.id, payload)
            .then( response => {
                context.commit('setServerResponse', response);
                toastr.success('Success', result.data.message);
                context.commit('clearClient');
                document.getElementById('clientDetailsForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
            })
        },
        deleteClient: (context, payload) => {
            axios.delete('api/clients/', + payload.id)
            .then( response => {
                toastr.success('Success', response.data.message)
            })
            .catch( error => {
                context.commit('setServerResponse', error.response);
            });
        }
    }
}