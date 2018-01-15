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
            axios.get(payload)
            .then(response => {
                context.commit('setAcquisitions', response);
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
        loadAcquisition: (context, payload) => {
            axios.get('api/maintainance/acquisitions/' + payload.id)
            .then(response => {
                context.commit('setAcquisition', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        storeAcquisition: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.post('api/maintainance/acquisitions', payload)
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
        updateAcquisition: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.patch('api/maintainance/acquisitions/' + payload.id, payload)
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
        deleteAcquisition: (context, payload) => {
            axios.delete('api/maintainance/acquisitions/' + payload.acquisition.id)
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