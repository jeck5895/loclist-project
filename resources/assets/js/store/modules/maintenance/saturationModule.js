export default {
    state: {
        saturations: [],
        saturation: {} 
    },
    getters: {
        getSaturations: state => {
            return state.saturations;
        },
        getSaturation: state => {
            return state.saturation;
        }
    },
    mutations: {
        clearSaturations: state => {
            state.saturations = [];
        },
        clearSaturation: state => {
            state.saturation = {};
        },
        setSaturations: (state, payload) => {
            state.saturations = payload.data;
        },
        setSaturation: (state, payload) => {
            state.saturation = payload.data;
        }
    },
    actions: {
        clearSaturations: context => {
            context.commit('clearSaturations');
        },
        clearSaturation: context => {
            context.commit('clearSaturation');
        },
        loadSaturations: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setSaturations', response);
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
        loadSaturation: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/saturations/' + payload.id)
                    .then(response => {
                        context.commit('setSaturation', response);
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
        storeSaturation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/saturations', payload)
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
                        context.commit('setServerResponse', error.response);
                        context.commit('setSubmitState', false);
                        reject(error)
                    });
            });
        },
        updateSaturation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/saturations/' + payload.id, payload)
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
                        context.commit('setServerResponse', error.response);
                        context.commit('setSubmitState', false);
                        reject(error);
                    });
            });
        },
        deleteSaturation: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/saturations/' + payload.saturation.id)
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
                        //toastr.error('Forbidden')
                        console.log(error.response)
                    });
            });
        }
    }
}