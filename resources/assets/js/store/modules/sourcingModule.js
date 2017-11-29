export default {
    state: {
        sourcing_practices: [],
        sourcing_pratice: {}
    },
    getters: {
        getSourcingPratices: state => {
            return state.sourcing_practices;
        },
        getSourcingPractice: state => {
            return state.sourcing_pratice;
        }
    },
    mutations: {
        clearSourcingPractices: state => {
            state.sourcing_practices = [];
        },
        clearSourcingPractice: state => {
            state.sourcing_pratice = {};
        },
        setSourcingPractices: (state, payload) => {
            state.sourcing_practices = payload.data;
            //console.log(payload.data)
        },
        setSourcingPractice: (state, payload) => {
            state.sourcing_pratice = payload.data;
        }
    },
    actions: {
        clearSourcingPractices: context => {
            context.commit('clearSourcingPractices');
        },
        clearSourcingPractice: context => {
            context.commit('clearSourcingPractice');
        },
        loadSourcingPractice: (context, payload) => {
            axios.get('api/sourcing_practices/' + payload.id)
            .then(response => {
                context.commit('setSourcingPractice', response);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        loadSourcingPractices: (context, payload) => {
            axios.get(payload)
            .then(response => {
                context.commit('setSourcingPractices', response)
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        storeSourcingPractice: (context, payload) => {
            axios.post('api/sourcing_practices', payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('sourcingForm').reset();
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                console.log(errors);
            });
        },
        updateSourcingPractice: (context, payload) => {
            axios.patch('api/sourcing_practices/' + payload.id, payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('sourcingForm').reset()
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
            })
        },
        deleteSourcingPractice: (context, payload) => {
            axios.delete('api/sourcing_practices/' + payload.sourcing_practice.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response.data);
            });
        }
    }
}