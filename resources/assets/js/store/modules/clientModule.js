
export default {
    state:{
        clients:[]
    },
    getters:{
        loadClients: state =>{
            return state.clients;
        }
    },
    mutations:{
        setClients: (state, payload) => {
            state.clients = payload.data;
        }
    },
    actions:{
        /* This where asynchronous/ajax calls perform and call mutation methods to assign response to state */
        loadClients: context =>{
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