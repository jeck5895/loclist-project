export default {
    state: {
        status: {},
        statuses: [],
        status_category: {},
        status_categories: []
    },
    getters: {
        getStatuses: state => {
            return state.statuses;
        },
        getStatus: state => {
            return state.status;
        },
        getStatusCategory: state => {
            return state.status_category;
        },
        getStatusCategories: state => {
            return state.status_categories;
        }
    },
    mutations: {
        clearStatus: state => {
            state.status = {};
        },
        clearStatuses: state => {
            state.statuses = [];
        },
        clearStatusCategory: state => {
            state.status_category = {};
        },
        clearStatusCategories: state => {
            state.status_categories = [];
        },
        setStatus: (state, payload) => {
            state.status = payload.data;
        },
        setStatuses: (state, payload) => {
            state.statuses = payload.data;
        },
        setStatusCategory: (state, payload) => {
            state.status_category = payload.data;
        },
        setStatusCategories: (state, payload) => {
            state.status_categories = payload.data;
        }
    },
    actions:{
        clearStatus: context => {
            context.commit('clearStatus');
        },
        clearStatuses: context => {
            context.commit('clearStatuses');
        },
        loadStatus: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/statuses/' + payload.id)
                    .then(response => {
                        context.commit('setStatus', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error);
                        }, 1000);
                    });
            });
        },
        loadStatuses: (context, payload) => {
            context.commit('setLoadingState', true);
            context.commit('clearStatuses');
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setStatuses', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error);
                        }, 1000);
                        console.log(error)
                    })
            });
        },
        loadStatusCategory: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/status-categories/' + payload.id)
                    .then(response => {
                        context.commit('setStatusCategory', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error);
                        }, 1000);
                    });
            });
        },
        loadStatusCategories: ({commit}, payload) => {
            commit('clearStatusCategories');
            commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        commit('setStatusCategories', response);
                        setTimeout(() => {
                            commit('setLoadingState', false);
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            commit('setLoadingState', false);
                            reject(error);
                        }, 1000);
                        console.log(error)
                    })
            });
        },
        storeStatus: (context, payload) => {
            context.commit('setSubmitState', true);
            
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/statuses', payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setServerResponse', errors);
                            context.commit('setSubmitState', false);
                            let errors = error.response;
                            reject(error)
                        }, 1000);
                        console.log(errors);
                    });
            });
        },
        updateStatus: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/statuses/' + payload.id, payload)
                    .then(response => {
                        context.commit('setServerResponse', response);
                        setTimeout(() => {
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        let errors = error.response;
                        context.commit('setServerResponse', errors);
                        setTimeout(() => {
                            context.commit('setSubmitState', false);
                            reject(error)
                        }, 1000);
                    })
            });
        },
        deleteStatus: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/statuses/' + payload.status.id)
                    .then(response => {
                        toastr.success('Success', response.data.message);
                        resolve(response)
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response.data);
                        if (error.response.status == 403) {
                            toastr.error('Error', error.response.data);
                        }
                        reject(error)
                    });
            });
        }
    }
 }