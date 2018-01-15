export default {
    state: {
        client_acquisitions: [],
        client_acquisition: {}
    },
    getters: {
        getClientAcquisitions: state => {
            return state.client_acquisitions;
        },
        getClientAcquisition: state => {
            return state.client_acquisition;
        }
    },
    mutations: {
        clearClientAcquisitions: state => {
            state.client_acquisitions = [];
        },
        clearClientAcquisition: state => {
            state.client_acquisition = {};
        },
        setClientAcquisitions: (state, payload) => {
            state.client_acquisitions = payload.data.model;
        },
        setClientAcquisition: (state, payload) => {
            state.client_acquisition = payload.data;
        }
    },
    actions: {
        clearClientAcquisitions: context => {
            context.commit('clearClientAcquisitions');
        },
        clearClientAcquisition: ({commit}) => {
            commit('clearClientAcquisition');  
        },
        loadClientAcquisitions: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setClientAcquisitions', response);
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
        loadClientAcquisition: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get('api/clients/' + payload.client_id + '/acquisitions/' + payload.acquisition_id)
            .then(response => {
                context.commit('setClientAcquisition', response);
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
        storeClientAcquisition: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/clients/' + payload.client_id + '/acquisitions', payload)
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
        updateClientAcquisition: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/clients/' + payload.client_id + '/acquisitions/' + payload.id, payload)
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
        deleteClientAcquisition: (context, payload) => {
            axios.delete('api/clients/' + payload.client_acquisition.client_id + '/acquisitions/' + payload.client_acquisition.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response.data);
                if (error.response.status == 403) {
                    toastr.error('Error', error.response.data);
                }
                console.log(error)
            });
        }
    }
}