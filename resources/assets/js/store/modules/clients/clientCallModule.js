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
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setClientCalls', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        console.log(error.response.data);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error)
                        }, 1000);
                    });
            });
        },
        loadClientCall: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/clients/' + payload.client_id + '/calls/' + payload.call_id)
                    .then(response => {
                        context.commit('setClientCall', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        console.log(error.response.data);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error)
                        }, 1000);
                    });
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
                    setTimeout(() => {
                        context.commit('setServerResponse', error.response);
                        context.commit('setSubmitState', false);
                        reject(error.response);
                    }, 1000);
                });
            });
        },
        updateClientCall: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/clients/' + payload.client_id + '/calls/' + payload.id, payload)
                .then(response => {
                    setTimeout(() => {
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        resolve(response);
                        //document.getElementById('departmentForm').reset();
                    }, 1000);
                })
                .catch(error => {
                    setTimeout(() => {
                        context.commit('setServerResponse', error.response);
                        context.commit('setSubmitState', false);
                        reject(error);
                    }, 1000);
                });
            });
        },
        deleteClientCall: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/clients/' + payload.client_call.client_id + '/calls/' + payload.client_call.id)
                    .then(response => {
                        toastr.success('Success', response.data.message);
                        resolve(response)
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response.data);
                        if (error.response.status == 403) {
                            toastr.error('Error', error.response.data);
                        }
                        reject(error)
                        console.log(error)
                    });
            })
        }
    }
}