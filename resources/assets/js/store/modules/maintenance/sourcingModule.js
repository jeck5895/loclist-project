export default {
    state: {
        sourcing_practices: [],
        sourcing_pratice: {}
    },
    getters: {
        getSourcingPratices: state => {
            return state.sourcing_practices;
        },
        getSourcingPractice: state => {
            return state.sourcing_pratice;
        }
    },
    mutations: {
        clearSourcingPractices: state => {
            state.sourcing_practices = [];
        },
        clearSourcingPractice: state => {
            state.sourcing_pratice = {};
        },
        setSourcingPractices: (state, payload) => {
            state.sourcing_practices = payload.data;
            //console.log(payload.data)
        },
        setSourcingPractice: (state, payload) => {
            state.sourcing_pratice = payload.data;
        }
    },
    actions: {
        clearSourcingPractices: context => {
            context.commit('clearSourcingPractices');
        },
        clearSourcingPractice: context => {
            context.commit('clearSourcingPractice');
        },
        loadSourcingPractice: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/sourcing_practices/' + payload.id)
                    .then(response => {
                        context.commit('setSourcingPractice', response);
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
            });
        },
        loadSourcingPractices: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setSourcingPractices', response);
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
                    })
            });
        },
        storeSourcingPractice: (context, payload) => {
            context.commit('setSubmitState', true);

            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/sourcing_practices', payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            // document.getElementById('sourcingForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        let errors = error.response;
                        context.commit('setServerResponse', errors);
                        context.commit('setSubmitState', false);
                        reject(error)
                        console.log(errors);
                    });
            });
        },
        updateSourcingPractice: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/sourcing_practices/' + payload.id, payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);

                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            // document.getElementById('sourcingForm').reset()
                        }, 1000);
                    })
                    .catch(error => {
                        let errors = error.response;
                        context.commit('setServerResponse', errors);
                        setTimeout(() => {
                            context.commit('setSubmitState', false);
                            reject(error)
                        }, 1000);
                    })
            })
        },
        deleteSourcingPractice: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/sourcing_practices/' + payload.sourcing_practice.id)
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
                    });
            });
        }
    }
}