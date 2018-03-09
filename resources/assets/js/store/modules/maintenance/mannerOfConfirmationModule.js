export default {
    state: {
        confirmations: [],
        confirmation: {}
    },
    getters: {
        getConfirmations: state => {
            return state.confirmations;
        },
        getConfirmation: state => {
            return state.confirmation;
        }
    },
    mutations: {
        clearConfirmations: state => {
            state.confirmations = [];
        },
        clearConfirmation: state => {
            state.confirmation = {};
        },
        setConfirmations: (state, payload) => {
            state.confirmations = payload.data;
        },
        setConfirmation: (state, payload) => {
            state.confirmation = payload.data;
        }
    },
    actions: {
        clearConfirmations: context => {
            context.commit('clearConfirmations');
        },
        clearConfirmation: context => {
            context.commit('clearConfirmation');
        },
        loadConfirmations: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setConfirmations', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
                console.log(error.response)
            }); 
        },
        loadConfirmation: (context, payload) => {
            axios.get('api/maintenance/confirmations/' + payload.id)
            .then(response => {
                context.commit('setConfirmation', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        storeConfirmation: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.post('api/maintenance/confirmations', payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('departmentForm').reset();
                }, 1000);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                context.commit('setSubmitState', false);
            });
        },
        updateConfirmation: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.patch('api/maintenance/confirmations/' + payload.id, payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('departmentForm').reset();
                }, 1000);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                context.commit('setSubmitState', false);
            });
        },
        deleteConfirmation: (context, payload) => {
            axios.delete('api/maintenance/confirmations/' + payload.confirmation.id)
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