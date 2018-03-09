
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
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    context.commit('setUserTypes', response);
                    setTimeout(() => {
                        context.commit('setLoadingState', false);
                        resolve(response)
                    }, 1000);
                })
                .catch(error => {
                    console.log(error.response.data)
                    reject(error)
                });
            });
        },
        loadUserType: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/user_types/' + payload.id)
                .then( response => {
                    context.commit('setUserType', response);
                    setTimeout(() => {
                        context.commit('setLoadingState', false);
                        resolve(response)
                    }, 1000);
                })
                .catch( error => {
                    console.log(error.response.data)
                    reject(error)
                })  
            });
        },
        storeUserType: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {  
                axios.post('api/maintenance/user_types', payload)
                .then( response => {
                    setTimeout(() => {
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        resolve(response);
                    // document.getElementById('userTypeForm').reset();
                    }, 1000);
                })
                .catch( error => {
                    if (error.response.status == 403) {
                        toastr.error('Error', error.response.data.message);
                    }
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                    reject(error)
                });
            });
        },
        updateUserType: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/user_types/' + payload.id, payload)
                .then( response => {
                    setTimeout(() => {
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        resolve(response)
                        //document.getElementById('userTypeForm').reset();
                    }, 1000);
                })
                .catch( error => {
                    if (error.response.status == 403) {
                        toastr.error('Error', error.response.data.message);
                    }
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                    reject(error)
                });
            });
        },
        deleteUserType: (context, payload) => {
            axios.delete('api/maintenance/user_types/' + payload.user_type.id)
            .then( response => {
                toastr.success('Success', response.data.message);
            })
            .catch( error => {
                context.commit('setServerResponse', error.response.data);
                if (error.response.status == 403) {
                    toastr.error('Error', error.response.data.message);
                }
            });
        }
    }
}