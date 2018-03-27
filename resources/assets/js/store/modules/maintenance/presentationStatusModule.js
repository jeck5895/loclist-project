export default {
    state : {
        presentation_statuses: [],
        presentation_status: {}
    },
    getters: {
        getPresentationStatuses: state => {
            return state.presentation_statuses;
        },
        getPresentationStatus: state => {
            return state.presentation_status;
        }
    },
    mutations: {
        clearPresentationStatuses: state => {
            state.presentation_statuses = [];
        },
        clearPresentationStatus: state => {
            state.presentation_status = {};
        },
        setPresentationStatuses: (state, payload) => {
            state.presentation_statuses = payload.data;
        },
        setPresentationStatus: (state, payload) => {
            state.presentation_status = payload.data;
        }
    },
    actions: {
        clearPresentationStatuses: context => {
            context.commit('clearPresentationStatuses');
        },
        clearPresentationStatus: context => {
            context.commit('clearPresentationStatus');
        },
        loadPresentationStatuses: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setPresentationStatuses', response);
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
        loadPresentationStatus: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/presentation-statuses/' + payload.id)
                    .then(response => {
                        context.commit('setPresentationStatus', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error);
                        }, 1000);
                        console.log(error.response)
                    });
            });
        },
        storePresentationStatus: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/presentation-statuses', payload)
                .then(response => {
                    setTimeout(() => {
                        
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        //document.getElementById('departmentForm').reset();
                        resolve(response);
                    }, 1000);
                })
                .catch(error => {
                    reject(error)
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                });
            })
        },
        updatePresentationStatus: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/presentation-statuses/' + payload.id, payload)
                .then(response => {
                    setTimeout(() => {
                        resolve(response);
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        //document.getElementById('departmentForm').reset();
                    }, 1000);
                })
                .catch(error => {
                    reject(error)
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                });
            });
        },
        deletePresentationStatus: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/presentation-statuses/' + payload.presentation_status.id)
                .then(response => {
                    resolve(response)
                    toastr.success('Success', response.data.message);
                })
                .catch(error => {
                    reject(error);
                    context.commit('setServerResponse', error.response.data);
                    if(error.response.status == 403){
                        toastr.error('Error', error.response.data);
                    }
                    //toastr.error('Forbidden')
                    console.log(error.response)
                });
            });
        }
    }
}