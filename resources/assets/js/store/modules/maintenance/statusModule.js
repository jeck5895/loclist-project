export default {
    state: {
        status: {

        },
        statuses: []
    },
    getters: {
        getStatuses: state => {
            return state.statuses;
        },
        getStatus: state => {
            return state.status;
        }
    },
    mutations: {
        clearStatus: state => {
            state.status = {};
        },
        clearStatuses: state => {
            state.statuses = [];
        },
        setStatus: (state, payload) => {
            state.status = payload.data;
        },
        setStatuses: (state, payload) => {
            state.statuses = payload.data;
        }
    },
    actions:{
        clearStatus: context => {
            context.commit('clearStatus');
        },
        clearStatuses: context => {
            context.commit('clearStatuses');
        },
        loadStatus: (context, payload) => {
            axios.get('api/maintenance/statuses/' + payload.id)
            .then(response => {
                context.commit('setStatus', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error)
            });
        },
        loadStatuses: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setStatuses', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error)
            })
        },
        storeStatus: (context, payload) => {
            context.commit('setSubmitState', true);
            
            axios.post('api/maintenance/statuses', payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                }, 1000);
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                context.commit('setSubmitState', false);
                console.log(errors);
            });
        },
        updateStatus: (context, payload) => {
            context.commit('setSubmitState', true);

            axios.patch('api/maintenance/statuses/' + payload.id, payload)
            .then(response => {
                setTimeout(()=>{
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                }, 1000);
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                context.commit('setSubmitState', false);
            })
        },
        deleteStatus: (context, payload) => {
            axios.delete('api/maintenance/statuses/' + payload.status.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response.data);
                if (error.response.status == 403) {
                    toastr.error('Error', error.response.data);
                }
            });
        }
    }
 }