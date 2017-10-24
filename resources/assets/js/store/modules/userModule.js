
export default{
    state:{
        users:[],
        user:{},
        serverResponse:false,
        curr_url: '/api/users',
        pages: 0,
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
        getCurrUrl: state => {
            return state.curr_url;
        },
        getTotalPage: state => {
            return state.pages;
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
        },
        setUrl: (state, payload) => {
            state.curr_url = payload;
        },
        setTotalPage: (state, payload) => {
            state.pages = payload;
        },
    },
    actions:{
        loadUsers: (context, payload) => {
            //change url for pagination 
            axios.get(payload)
            .then(response => {
                console.log(response);
                var pages = Math.round(response.data.total / response.data.per_page);
                context.commit('setUsers', response);
                context.commit('setTotalPage', pages);
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
        setUrl: (context, payload) => {
            context.commit('setUrl', payload);
        },
        setTotalPages: (pages, payload) => {
            context.commit('setTotalPages', payload);
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
            //console.log(payload)
            axios.delete('api/users/' + payload.user.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                console.log()
            });
        }
    }
}