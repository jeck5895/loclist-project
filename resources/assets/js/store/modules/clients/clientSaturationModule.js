export default {
    state: {
        client_saturations: [],
        client_saturation: {}
    },
    getters: {
        getClientSaturations: state => {
            return state.client_saturations;
        },
        getClientSaturation: state => {
            return state.client_saturation;
        }
    },
    mutations: {
        clearClientSaturations: state => {
            state.client_saturations = [];
        },
        clearClientSaturation: state => {
            state.client_saturation = {};
        },
        setClientSaturations: (state, payload) => {
            state.client_saturations = payload.data.model;
        },
        setClientSaturation: (state, payload) => {
            state.client_saturation = payload.data;
        }
    },
    actions: {
        clearClientSaturations: context => {
            context.commit('clearClientSaturations');
        },
        clearClientSaturation: context => {
            context.commit('clearClientSaturation');
        },
        loadClientSaturations: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setClientSaturations', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response.data);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            });
        },
        loadClientSaturation: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get('api/clients/' + payload.client_id + '/saturations/' + payload.saturation_id)
            .then(response => {
                context.commit('setClientSaturation', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response.data);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            });
        },
        storeClientSaturation: (context, payload) => {

        },
        updateClientSaturation: (context, payload) => {

        },
        deleteClientSaturation: (context, payload) => {

        }
    }
}