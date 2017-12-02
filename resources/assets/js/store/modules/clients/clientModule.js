
export default {
    state:{
        clients: [],
        client: {}
    },
    getters:{
        loadClients: state =>{
            return state.clients;
        }
    },
    mutations:{
        //create clear
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
            axios.get('/api/clients')
            .then(response => {
                context.commit('setClients', response);
            })
            .catch(error => {
                alert(error.response.data);
            });
        }
    }
}