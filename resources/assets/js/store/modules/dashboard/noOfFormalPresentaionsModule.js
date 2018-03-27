export default {
    state : {
        no_of_formal_presentations: {},
        no_of_formal_presentations_is_loading: false
    },
    getters : {
        getNoOfFormalPresentations: state => {
            return state.no_of_formal_presentations;
        },
        getNoOfFormalPresentationsLoadingState: state => {
            return state.no_of_formal_presentations_is_loading;
        }
    },
    mutations : {
        clearNoOfFormalPresentations: state => {
            state.no_of_formal_presentations_is_loading = {};
        },
        setNoOfFormalPresentations: (state, payload) => {
            state.no_of_formal_presentations = payload.data;
        },
        setNoOfFormalPresentationsLoadingState: (state, payload) => {
            state.no_of_formal_presentations_is_loading = payload
        }
    }, 
    actions : {
        loadNoOfFormalPresentations: ({commit}, payload) => {
            commit('clearNoOfFormalPresentations');
            commit('setNoOfFormalPresentationsLoadingState', true);

            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    commit('setNoOfFormalPresentations', response);
                    setTimeout(() => {
                        commit('setNoOfFormalPresentationsLoadingState', false);
                        resolve(response);
                    }, 1000);
                })
                .catch(error => {
                    commit('setNoOfFormalPresentationsLoadingState', false);
                    reject(error);
                    console.error(error)
                })
            });
        }
    }
}