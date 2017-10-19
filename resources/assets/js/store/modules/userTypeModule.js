
export default{
    state:{
        user_types:[]
    },
    getters:{
        loadUserTypes: state => {
            return state.user_types;
        }
    },
    mutations:{
        setUserTypes: (state, payload) => {
            state.user_types = payload.data;
        }
    },
    actions:{
        loadUserTypes: context => {
            axios.get('/api/user_types')
            .then(response => {
                context.commit('setUserTypes', response);
            })
            .catch(errors => {
                console.log(errors.response.data)
            });
        }
    }
}