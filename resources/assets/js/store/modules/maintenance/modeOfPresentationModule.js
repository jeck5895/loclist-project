export default {
    state : {
        mode_of_presentations: [],
        mode_of_presentation: {}
    },
    getters: {
        getModeOfPresentations: state => {
            return state.mode_of_presentations;
        },
        getModeOfPresentation: state => {
            return state.mode_of_presentation;
        }
    },
    mutations: {
        clearModeOfPresentations: state => {
            state.mode_of_presentations = [];
        },
        clearModeOfPresentation: state => {
            state.mode_of_presentation = {};
        },
        setModeOfPresentations: (state, payload) => {
            state.mode_of_presentations = payload.data;
        },
        setModeOfPresentation: (state, payload) => {
            state.mode_of_presentation = payload.data;
        }
    },
    actions: {
        clearModeOfPresentations: context => {
            context.commit('clearModeOfPresentations');
        },
        clearModeOfPresentation: context => {
            context.commit('clearModeOfPresentation');
        },
        loadModeOfPresentations: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setModeOfPresentations', response);
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
        loadModeOfPresentation: (context, payload) => {
            axios.get('api/maintenance/mode-of-presentations/' + payload.id)
            .then(response => {
                context.commit('setModeOfPresentation', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        storeModeOfPresentation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/mode-of-presentations', payload)
                .then(response => {
                    setTimeout(() => {
                        resolve(response)
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
        updateModeOfPresentation: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/mode-of-presentations/' + payload.id, payload)
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
                    reject(error);
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                });
            });
        },
        deleteModeOfPresentation: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/mode-of-presentations/' + payload.mode_of_presentation.id)
                .then(response => {
                    toastr.success('Success', response.data.message);
                })
                .catch(error => {
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