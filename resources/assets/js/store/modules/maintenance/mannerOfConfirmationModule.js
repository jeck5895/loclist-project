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
            return new Promise((resolve, reject) => {
                context.commit('setLoadingState', true);
                axios.get(payload)
                    .then(response => {
                        context.commit('setConfirmations', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error)
                        }, 1000);
                        console.log(error.response)
                    }); 
            })
        },
        loadConfirmation: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/confirmations/' + payload.id)
                    .then(response => {
                        context.commit('setConfirmation', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response);
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error);
                        }, 1000);
                        console.log(error.response)
                    });
            })
        },
        storeConfirmation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/confirmations', payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            //document.getElementById('departmentForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setServerResponse', error.response);
                            context.commit('setSubmitState', false);
                            reject(error)
                        }, 1000);
                    });
            });
        },
        updateConfirmation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/confirmations/' + payload.id, payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            //document.getElementById('departmentForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setServerResponse', error.response);
                            context.commit('setSubmitState', false);
                            reject(error)
                        }, 1000);
                    });
            });
        },
        deleteConfirmation: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/confirmations/' + payload.confirmation.id)
                    .then(response => {
                        toastr.success('Success', response.data.message);
                        resolve(response)
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response.data);
                        if (error.response.status == 403) {
                            toastr.error('Error', error.response.data);
                        }
                        reject(error);
                        console.log(error)
                    });
            })
        }
    }
}