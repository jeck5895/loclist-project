export default {
    state: {
        client_saturations: [],
        client_saturation: {}
    },
    getters: {
        getClientSaturations: state => {
            return state.client_saturations;
        },
        getClientSaturation: state => {
            return state.client_saturation;
        }
    },
    mutations: {
        clearClientSaturations: state => {
            state.client_saturations = [];
        },
        clearClientSaturation: state => {
            state.client_saturation = {};
        },
        setClientSaturations: (state, payload) => {
            state.client_saturations = payload.data.model;
        },
        setClientSaturation: (state, payload) => {
            state.client_saturation = payload.data;
        }
    },
    actions: {
        clearClientSaturations: context => {
            context.commit('clearClientSaturations');
        },
        clearClientSaturation: context => {
            context.commit('clearClientSaturation');
        },
        loadClientSaturations: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setClientSaturations', response);
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
        loadClientSaturation: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get('api/clients/' + payload.client_id + '/saturations/' + payload.saturation_id)
            .then(response => {
                context.commit('setClientSaturation', response);
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
        storeClientSaturation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/clients/' + payload.client_id + '/saturations', payload)
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
        updateClientSaturation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/clients/' + payload.client_id + '/saturations/' + payload.id, payload)
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
        deleteClientSaturation: (context, payload) => {

        }
    }
}