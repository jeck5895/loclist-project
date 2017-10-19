
export default{
    state:{
        users:[],
        user:{},
        serverResponse:false
    },
    getters:{
        loadUsers: state => {
            return state.users;
        },
        loadUser: state => {
            return state.user;
        },
        getServerResponse: state => {
            return state.serverResponse;
        },
    },
    mutations:{
        setUsers: (state, payload) => {
            state.users = payload.data;
        },
        setUser: (state, payload) => {
            state.user = payload.data;
        },
        setServerResponse: (state, payload) => {
            state.serverResponse = payload;
        },
        clearServerResponse: state =>{
            state.serverResponse = false;
        }
    },
    actions:{
        loadUsers: context => {
            axios.get('/api/users')
            .then(response => {
                //console.log(response)
                context.commit('setUsers', response);
            })
            .catch(error => {
                console.log(error.response.data)
            });
        },
        loadUser: (context, payload) => {
            axios.get('/api/users/' + payload.id)
            .then(response => {
                context.commit('setUser', response);
            })
            .catch(errors => {
                console.log(errors.response.data);
            });
        },
        createUser: (context, payload) => {
            axios.post('api/user', payload)
            .then(response => {
                let result = response;
                context.commit('setServerResponse', result);
                $("#createUserModal").modal('hide');
                toastr.success('Success', 'User '+ result.data.name + ' has been saved');
                //console.log(result);
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                console.log(errors);
            });
        },
        updateUser: (context, payload) => {
            // console.log('update');
            // console.log(payload)
            axios.patch('api/user', payload)
            .then(response => {
                console.log(response);
            })
            .catch(error => {
                console.log(error.response.data)
            });
        },
        deleteUser: (context, payload) => {

        }
    }
}