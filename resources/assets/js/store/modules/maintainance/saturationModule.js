export default {
    state: {
        saturations: [],
        saturation: {} 
    },
    getters: {
        getSaturations: state => {
            return state.saturations
        },
        getSaturation: state => {
            return state.saturation;
        }
    },
    mutations: {
        clearSaturations: state => {
            state.saturations = [];
        },
        clearSaturation: state => {
            state.saturation = {};
        },
        setSaturations: (state, payload) => {
            state.saturations = payload.data;
        },
        setSaturation: (state, payload) => {
            state.saturation = payload.data;
        }
    },
    actions: {
        clearSaturations: context => {
            context.commit('clearSaturations');
        },
        clearSaturation: context => {
            context.commit('clearSaturation');
        },
        loadSaturations: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setSaturations', response);
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
        loadSaturation: (context, payload) => {
            axios.get('api/saturations/' + payload.id)
            .then(response => {
                context.commit('setSaturation', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response)
            });
        }
    }
}