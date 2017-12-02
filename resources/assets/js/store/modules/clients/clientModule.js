
export default {
    state:{
        clients: [],
        client: {}
    },
    getters:{
        getClients: state => {
            return state.clients;
        },
        getClient: state => {
            return state.client;
        }
    },
    mutations:{

        clearClient: state => {
            state.client = {};
        },
        clearClients: state => {
            state.clients = [];
        },
        setClients: (state, payload) => {
            state.clients = payload.data;
        },
        setClient: (state, payload) => {
            state.client = payload.data;
        }
    },
    actions:{
        /* This where asynchronous/ajax calls perform and call mutation methods to assign response to state */
        clearClient: context => {
            context.commit('clearClient');
        },
        clearClients: context => {
            context.commit('clearClients');
        },
        loadClient: (context, payload) => {
            axios.get('api/clients/', + payload.id)
            .then(response => {
                context.commit('setClient', response);
            })
            .catch(error => {
                console.log(error.response);
            });
        },
        loadClients: (context, payload) => {
            axios.get(payload)
            .then(response => {
                context.commit('setClients', response);
            })
            .catch(error => {
                alert(error.response.data);
            });
        },
        storeClient: (context, payload) => {
            axios.post('api/clients', payload)
            .then( response => {
                context.commit('setServerResponse', response);
                toastr.success('Success', result.data.message);
                document.getElementById('clientDetailsForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);

            });
        },
        updateClient: (context, payload) => {
            axios.patch('api/clients/' + payload.id, payload)
            .then( response => {
                context.commit('setServerResponse', response);
                toastr.success('Success', result.data.message);
                document.getElementById('clientDetailsForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
            })
        },
        deleteClient: (context, payload) => {
            axios.delete('api/clients/', + payload.id)
            .then( response => {
                toastr.success('Success', response.data.message)
            })
            .catch( error => {
                context.commit('setServerResponse', error.response);
            });
        }
    }
}