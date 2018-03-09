export default {
    state: {
        position: {},
        positions: []
    },
    getters: {
        getPosition: state => {
            return state.position;
        },
        getPositions: state => {
            return state.positions;
        }
    },
    mutations: {
        clearPosition: state => {
            state.position = {};
        },
        clearPositions: state => {
            state.positions = [];
        },
        setPosition: (state, payload) => {
            state.position = payload.data;
        },
        setPositions: (state, payload) => {
            state.positions = payload.data;
        }
    },
    actions: {
        clearPosition: context => {
            context.commit('clearPosition');
        },
        clearPositions: context => {
            context.commit('clearPositions');
        },
        loadPositions: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setPositions', response);
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
        loadPosition: (context, payload) => {
            
            axios.get('api/maintenance/positions/' + payload.id)
            .then(response => {
                context.commit('setPosition', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        storePosition: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.post('api/maintenance/positions', payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    // document.getElementById('positionForm').reset();
                }, 1000);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                context.commit('setSubmitState', false);
            });
        },
        updatePosition: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.patch('api/maintenance/positions/' + payload.id, payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('positionForm').reset();
                }, 1000);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                context.commit('setSubmitState', false);
            });
        },
        deletePosition: (context, payload) => {
            axios.delete('api/maintenance/positions/' + payload.position.id)
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