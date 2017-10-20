
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
        clearUser: state => {
            state.user = {};
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
        clearUser: context => {
            context.commit('clearUser');
        },
        createUser: (context, payload) => {
            axios.post('api/users', payload)
            .then(response => {
                let result = response;
                context.commit('setServerResponse', result);
                $("#createUserModal").modal('hide');
                toastr.success('Success', result.data.message);
                document.getElementById('userForm').reset();
                console.log(result);
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                //toastr.error('Error', 'Oops! something went wrong');
                console.log(errors);
            });
        },
        updateUser: (context, payload) => {
            axios.patch('api/users/' + payload.id, payload, payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('userForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                console.log(error.response.data)
            });
        },
        deleteUser: (context, payload) => {

        }
    }
}