export default {
    state : {
        proposals_tobe_sent : {},
        proposals_tobe_sent_is_loading: false
    },
    getters : {
        getProposalsToBeSent: state => {
            return state.proposals_tobe_sent;
        },
        getProposalsToBeSentLoadingState: state => {
            return state.proposals_tobe_sent_is_loading;
        }
    },
    mutations : {
        clearProposalsToBeSent: state => {
            state.proposals_tobe_sent = {};
        },
        setProposalsToBeSent: (state, payload) => {
            state.proposals_tobe_sent = payload.data;
        },
        setProposalsToBeSentIsLoading: (state, payload) => {
            state.proposals_tobe_sent_is_loading = payload ;
        }
    },
    actions : {
        loadProposalsToBeSent: ({commit}, payload) => {
            commit('clearProposalsToBeSent');
            commit('setProposalsToBeSentIsLoading', true);

            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    commit('setProposalsToBeSent', response);
                    setTimeout(() => {
                        commit('setProposalsToBeSentIsLoading', false);
                        resolve(response);  
                    }, 1000);
                }) 
                .catch(error => {
                    console.error(error);
                    commit('setProposalsToBeSentIsLoading', false);
                    reject(error);
                });
            });
        }
    }
}