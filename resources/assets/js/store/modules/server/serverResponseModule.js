export default{
    state:{
        isLoading: false,
        isSubmitted: false,
        serverResponse: false,
    },
    getters: {
        getSubmitState: state => {
            return state.isSubmitted;
        },
        getLoadingState: state => {
            return state.isLoading;
        },
        getServerResponse: state => {
            return state.serverResponse;
        },
    },
    mutations: {
        setSubmitState: (state, payload) => {
            state.isSubmitted = payload;
        },
        setLoadingState: (state, payload) => {
            state.isLoading = payload;
        },
        setServerResponse: (state, payload) => {
            state.serverResponse = payload;
        },
        clearServerResponse: state => {
            state.serverResponse = false;
        },
    },
    actions: {
        setLoadingState: (context, payload) => {
            context.commit('setLoadingState', payload);
        },
        setSubmitState: (context, payload) => {
            context.commit('setSubmitState', payload);
        }
    }
}