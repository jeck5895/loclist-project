
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
            context.commit('setSubmitState', true);

            return new Promise((resolve, reject) => {
                axios.post('api/users', payload)
                .then(response => {
                    setTimeout(() => {
                        let result = response;
                        context.commit('setServerResponse', result);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', result.data.message);
                        document.getElementById('userForm').reset();
                        resolve(response)
                    }, 1000);
                
                })
                .catch(error => {
                    setTimeout(() => {
                       let errors = error.response;
                       context.commit('setServerResponse', errors);
                       context.commit('setSubmitState', false);
                       //toastr.error('Error', 'Oops! something went wrong');
                       console.log(errors);
                       reject(error);
                    }, 1000);
                });
            });
        },
        updateUser: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/users/' + payload.id, payload, payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            document.getElementById('userForm').reset();
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setServerResponse', error.response);
                            context.commit('setSubmitState', false);
                            console.log(error.response.data);
                            reject(error);
                        }, 1000);
                    });
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