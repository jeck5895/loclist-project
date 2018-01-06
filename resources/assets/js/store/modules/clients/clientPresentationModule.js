export default {
    state: {
        client_presentation: {},
        client_presentations: []
    },
    getters: {
        getClientPresentation: state => {
            return state.client_presentation;
        },
        getClientPresentations: state => {
            return state.client_presentations;
        }
    },
    mutations: {
        clearClientPresentation: state => {
            state.client_presentation = {};
        },
        clearClientPresentations: state => {
            state.client_presentations = [];
        },
        setClientPresentation: (state, payload) => {
            state.client_presentation = payload.data;
        },
        setClientPresentations: (state, payload) => {
            state.client_presentations = payload.data.model;
        }
    },
    actions: {
        clearClientPresentation: context => {
            context.commit('clearClientPresentation');
        },
        clearClientPresentations: context => {
            context.commit('clearClientPresentations');
        },
        loadClientPresentation: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get('api/clients/' + payload.client_id + '/presentations/' + payload.presentation_id)
            .then(response => {
                context.commit('setClientPresentation', response);
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
        loadClientPresentations: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setClientPresentations', response);
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
        storeClientPresentation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/clients/' + payload.client_id + '/presentations', payload)
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
        updateClientPresentation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/clients/' + payload.client_id + '/presentations/' + payload.id, payload)
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
        deleteClientPresentation: (context, payload) => {
            axios.delete('api/clients/' + payload.client_presentation.client_id + '/presentations/' + payload.client_presentation.id)
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