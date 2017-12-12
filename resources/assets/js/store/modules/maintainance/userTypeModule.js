
export default{
    state:{
        user_types: [],
        user_type: {}
    },
    getters:{
        getUserTypes: state => {
            return state.user_types;
        },
        getUserType: state => {
            return state.user_type;
        }
    },
    mutations:{
        clearUserTypes: state => {
            state.user_types = [];
        },
        clearUserType: state => {
            state.user_type = {};
        },
        setUserTypes: (state, payload) => {
            state.user_types = payload.data;
        },
        setUserType: (state, payload) => {
            state.user_type = payload.data;
        }
    },
    actions:{
        clearUserType: context => {
            context.commit('clearUserType');
        },
        clearUserTypes: context => {
            context.commit('clearUserTypes');
        },
        loadUserTypes: (context, payload) => {
            axios.get(payload)
            .then(response => {
                context.commit('setUserTypes', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response.data)
            });
        },
        loadUserType: (context, payload) => {
            axios.get('api/user_types/' + payload.id)
            .then( response => {
                context.commit('setUserType', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch( error => {
                console.log(error.response.data)
            })  
        },
        storeUserType: (context, payload) => {
            axios.post('api/user_types', payload)
            .then( response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                // document.getElementById('userTypeForm').reset();
                }, 1000);
            })
            .catch( error => {
                context.commit('setServerResponse', error.response);
            });
        },
        updateUserType: (context, payload) => {
            axios.patch('api/user_types/' + payload.id, payload)
            .then( response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('userTypeForm').reset();
                }, 1000);
            })
            .catch( error => {
                context.commit('setServerResponse', error.response);
            });
        },
        deleteUserType: (context, payload) => {
            axios.delete('api/user_types/' + payload.user_type.id)
            .then( response => {
                toastr.success('Success', response.data.message);
            })
            .catch( error => {
                context.commit('setServerResponse', error.response.data);
            });
        }
    }
}