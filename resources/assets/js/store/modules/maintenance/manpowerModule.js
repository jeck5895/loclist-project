export default {
    state: {
        manpowers: [],
        manpower: {}
    },
    getters: {
        getManpowers: state => {
            return state.manpowers;
        },
        getManpower: state => {
            return state.manpower;
        }
    },
    mutations: {
        clearManpowers: state => {
            state.manpowers = [];
        },
        clearManpower: state => {
            state.manpower = {}
        },
        setManpowers: (state, payload) => {
            state.manpowers  = payload.data;
        },
        setManpower: (state, payload) => {
            state.manpower = payload.data;
        }
    },
    actions: {
        clearManpowers: context => {
            context.commit('clearManpowers');
        },
        clearManpower: context => {
            context.commit('clearManpower');
        },
        loadManpowers: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setManpowers', response);
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
                        console.log(error.response);
                    });
            });
        },
        loadManpower: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/manpowers/' + payload.id)
                    .then(response => {
                        context.commit('setManpower', response);
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
                        console.log(error.response);
                    })
            })
        },
        storeManpower: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/manpowers', payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            //document.getElementById('manpowerForm').reset(); 
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
        updateManpower: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/manpowers/' + payload.id, payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            //document.getElementById('manpowerForm').reset(); 
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
        deleteManpower: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/manpowers/' + payload.manpower.id)
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
            });
        }
    }
}