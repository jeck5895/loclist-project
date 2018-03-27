export default {
    state: {
        acquisitions: [],
        acquisition: {}
    },
    getters: {
        getAcquisitions: state => {
            return state.acquisitions;
        },
        getAcquisition: state => {
            return state.acquisition;
        }
    },
    mutations: {
        clearAcquisitions: state => {
            state.acquisitions = [];
        },
        clearAcquisition: state => {
            state.acquisition = {};
        },
        setAcquisitions: (state, payload) => {
            state.acquisitions = payload.data;
        },
        setAcquisition: (state, payload) => {
            state.acquisition = payload.data;
        }
    },
    actions: {
        clearAcquisitions: context => {
            context.commit('clearAcquisitions');
        },
        clearAcquisition: context => {
            context.commit('clearAcquisition');
        },
        loadAcquisitions: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setAcquisitions', response);
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
        loadAcquisition: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/acquisitions/' + payload.id)
                    .then(response => {
                        context.commit('setAcquisition', response);
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
        storeAcquisition: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/acquisitions', payload)
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
                            reject(error);
                        }, 1000);
                    });
            });
        },
        updateAcquisition: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/acquisitions/' + payload.id, payload)
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
        deleteAcquisition: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/acquisitions/' + payload.acquisition.id)
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
            });
        }
    }
}