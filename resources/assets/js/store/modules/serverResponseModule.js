export default{
    state:{
        isLoading:false,
        serverResponse: false,
    },
    getters: {
        getLoadingState: state => {
            return state.isLoading;
        },
        getServerResponse: state => {
            return state.serverResponse;
        },
    },
    mutations: {
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
        }
    }
}