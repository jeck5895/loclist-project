export default {
    state: {
        nationality: {},
        nationalities: []
    },
    getters: {
        getNationality:state => {
            return state.nationality;
        },
        getNationalities: state => {
            return state.nationalities;
        }
    },
    mutations: {
        clearNationalities: state => {
            state.nationalities = [];
        },
        clearNationality: state => {
            state.nationality = {};
        },
        setNationality: (state, payload) => {
            state.nationality = payload.data;
        },
        setNationalities: (state, payload) => {
            state.nationalities = payload.data;
        }   
    },
    actions: {
        clearNationalities: context => {
            context.commit('clearNationalities');
        },
        clearNationality: context => {
            var {commit} = context; //destructuring object
            commit('clearNationality');
        },
        loadNationality: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/nationalities/' + payload.id)
                    .then(response => {
                        context.commit('setNationality', response);
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
                        console.log(error.response.data)
                    });
            });
        },
        loadNationalities: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setNationalities', response);
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
                        console(error)
                    });
            })
        },
        storeNationality : (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/nationalities', payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            //document.getElementById('nationalityForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        let errors = error.response;
                        context.commit('setServerResponse', errors);
                        setTimeout(() => {
                            context.commit('setSubmitState', false);
                            reject(error);
                        }, 1000);
                        //toastr.error('Error', 'Oops! something went wrong');
                        console.log(errors);
                    });
            });
        },
        updateNationality: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/nationalities/' + payload.id, payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            //document.getElementById('nationalityForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response);
                        setTimeout(() => {
                            context.commit('setSubmitState', false);
                            reject(error);
                        }, 1000);
                        console.log(error.response)
                    });
            });
        },
        deleteNationality: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/nationalities/' + payload.nationality.id)
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
                    });
            });
        }
    }
}