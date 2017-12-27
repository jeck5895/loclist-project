export default {
    state: {
        confirmations: [],
        confirmation: {}
    },
    getters: {
        getConfirmations: state => {
            return state.confirmations;
        },
        getConfirmation: state => {
            return state.confirmation;
        }
    },
    mutations: {
        clearConfirmations: state => {
            state.confirmations = [];
        },
        clearConfirmation: state => {
            state.confirmation = {};
        },
        setConfirmations: (state, payload) => {
            state.confirmations = payload.data;
        },
        setConfirmation: (state, payload) => {
            state.confirmation = payload.data;
        }
    },
    actions: {
        clearConfirmations: context => {
            context.commit('clearConfirmations');
        },
        clearConfirmation: context => {
            context.commit('clearConfirmation');
        },
        loadConfirmations: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setConfirmations', response);
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
        loadConfirmation: (context, payload) => {
            axios.get('api/confirmations/' + payload.id)
            .then(response => {
                context.commit('setConfirmation', response);
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