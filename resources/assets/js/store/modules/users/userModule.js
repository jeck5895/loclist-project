
export default{
    state:{
        users:[],
        user:{},
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
        getCurrUrl: state => {
            return state.curr_url;
        },
        getTotalPage: state => {
            return state.pages;
        },
    },
    mutations:{
        setUsers: (state, payload) => {
            state.users = payload.data.model;
        },
        setUser: (state, payload) => {
            state.user = payload.data;
        },
        clearUser: state => {
            state.user = {};
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
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                // console.log(response);
                var pages = Math.round(response.data.total / response.data.per_page);
                console.log(response)
                context.commit('setUsers', response);
                context.commit('setTotalPage', pages);
                context.commit('setColumns', response.data.columns);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                setTimeout(() => {
                    context.dispatch('setLoadingState', false);
                }, 1000);
                console.log(error.response.data)
            });
        },
        loadUser: (context, payload) => {
            context.dispatch('setLoadingState', true);

            axios.get('/api/users/' + payload.id)
            .then(response => {
                context.commit('setUser', response);
                setTimeout(() => {
                    context.dispatch('setLoadingState', false);
                }, 1000);
            })
            .catch(errors => {
                setTimeout(() => {
                    context.dispatch('setLoadingState', false);
                }, 1000);
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
        storeUser: (context, payload) => {
            axios.post('api/users', payload)
            .then(response => {
                let result = response;
                context.commit('setServerResponse', result);
                $("#createUserModal").modal('hide');
                toastr.success('Success', result.data.message);
                document.getElementById('userForm').reset();
            
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
                context.commit('setServerResponse', error.response.data);
                console.log(error)
            });
        }
    }
}