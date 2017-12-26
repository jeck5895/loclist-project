export default {
    state: {
        client_call: {},
        client_calls: []
    },
    getters: {
        getClientCall: state => {
            return state.client_call;
        },
        getClientCalls: state => {
            return state.client_calls;
        }
    },
    mutations: {
        clearClientCall: state => {
            state.client_call = {};
        },
        clientClientCalls: state => {
            state.client_calls = [];
        },
        setClientCall: (state, payload) => {
            state.client_call = payload.data;
        },  
        setClientCalls: (state, payload) => {
            state.client_calls = payload.data.model;
        }
    },
    actions: {
        clearClientCall: context => {
            context.commit('clearClientCall');
        },
        clearClientCalls: context => {
            context.commit('clearClientCalls');
        },
        loadClientCalls: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setClientCalls', response);
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
        loadClientCall: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get('api/clients/' + payload.client_id + '/calls/' + payload.call_id)
            .then(response => {
                context.commit('setClientCall', response);
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
        storeClientCall: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/clients/' + payload.client_id + '/calls', payload)
                .then(response => {
                    setTimeout(() => {
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        resolve(response);
                    }, 1000);
                })
                .catch(error => {
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                    reject(error.response);
                });
            });
        },
        updateClientCall: (context, payload) => {
            
        },
        deleteClientCall: (context, payload) => {

        }
    }
}