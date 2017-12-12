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
            axios.get('api/nationalities/' + payload.id)
            .then(response => {
                context.commit('setNationality', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response.data)
            });
        },
        loadNationalities: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setNationalities', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
                console(error)
            });
        },
        storeNationality : (context, payload) => {
            axios.post('api/nationalities', payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                //document.getElementById('nationalityForm').reset();
                }, 1000);
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                //toastr.error('Error', 'Oops! something went wrong');
                console.log(errors);
            });
        },
        updateNationality: (context, payload) => {
            axios.patch('api/nationalities/' + payload.id, payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('nationalityForm').reset();
                }, 1000);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                console.log(error.response)
            });
        },
        deleteNationality: (context, payload) => {
            axios.delete('api/nationalities/' + payload.nationality.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response.data);
            });
        }
    }
}