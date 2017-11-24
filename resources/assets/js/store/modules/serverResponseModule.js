export default{
    state:{
        serverResponse: false,
    },
    getters: {
        getServerResponse: state => {
            return state.serverResponse;
        },
    },
    mutations: {
        setServerResponse: (state, payload) => {
            state.serverResponse = payload;
        },
        clearServerResponse: state => {
            state.serverResponse = false;
        },
    },
    actions: {

    }
}