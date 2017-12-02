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
            axios.get(payload)
            .then( response => {
                context.commit('setManpowers', response);
            })
            .catch( error => {
                console.log(error.response);
            });
        },
        loadManpower: (context, payload) => {
            axios.get('api/manpowers/' + payload.id)
            .then(response => {
                context.commit('setManpower', response);
            })
            .catch(error => {
                console.log(error.response);
            })
        },
        storeManpower: (context, payload) => {
            axios.post('api/manpowers', payload)
            .then( response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('manpowerForm').reset();   
            })
            .catch(error =>{
                context.commit('setServerResponse', error.response);
            });
        },
        updateManpower: (context, payload) => {
            axios.patch('api/manpowers/' + payload.id, payload)
            .then( response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('manpowerForm').reset();   
            })
            .catch( error => {
                context.commit('setServerResponse', error.response);
            });
        },
        deleteManpower: (context, payload) => {
            axios.delete('api/manpowers/' + payload.manpower.id)
            .then( response => {
                toastr.success('Success', response.data.message);
            })
            .catch( error => {
                context.commit('setServerResponse', error.response.data);
                console.log(error)
            });
        }
    }
}