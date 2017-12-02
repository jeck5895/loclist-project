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
            axios.get(payload)
            .then(response => {
                context.commit('setPositions', response);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        loadPosition: (context, payload) => {
            axios.get('api/positions/' + payload.id)
            .then(response => {
                context.commit('setPosition', response);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        storePosition: (context, payload) => {
            axios.post('api/positions', payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('positionForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
            });
        },
        updatePosition: (context, payload) => {
            axios.patch('api/positions/' + payload.id, payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('positionForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
            });
        },
        deletePosition: (context, payload) => {
            axios.delete('api/positions/' + payload.position.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response.data);
                console.log(error)
            });
        }
    }
}