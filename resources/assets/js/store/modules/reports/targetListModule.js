export default{
    state: {
        target_list: {},
        target_lists: [],
        report_years:[]
    },
    getters: {
        getTargetList: state => {
            return state.target_list;
        },
        getTargetLists: state => {
            return state.target_lists;
        },
        getTargetListYears: state => {
            return state.report_years;
        }
    },
    mutations: {
        clearTargetList: state => {
            state.target_list = {};
        },
        clearTargetLists: state => {
            state.target_lists = [];
        },
        setTargetList: (state, payload) => {
            state.target_list = payload.data;
        },  
        setTargetLists: (state, payload) => {
            state.target_lists = payload.data;
        },
        setTargetListYears: (state, payload) => {
            state.report_years = payload.data;
        }
    },
    actions: {
        clearTargetList: context => {
            context.commit('clearTargetList');
        },
        clearTargetLists: context => {
            context.commit('clearTargetLists');
        },
        loadTargetList: ({commit}, payload) => {
            commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/reports/target-lists/' + payload.id)
                .then(response => {
                    commit('setTargetList', response);
                    resolve(response);
                    setTimeout(() => {
                        commit('setLoadingState', false);
                    }, 1000);
                })
                .catch(error => {
                    reject(error);
                    setTimeout(() => {
                        commit('setLoadingState', 1000);
                    }, 1000);
                });
            });
        },
        loadTargetLists: ({commit}, payload) => {
            commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    commit('setTargetLists', response);
                    resolve(response);
                    setTimeout(() => {
                        commit('setLoadingState', false);
                    }, 1000);
                })
                .catch(error => {
                    reject(error);
                    setTimeout(() => {
                        commit('setLoadingState', 1000);
                    }, 1000);
                });
            });
        },
        loadTargetListYears: ({commit}) => {
            commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/reports/target-lists/years')
                .then(response => {
                    commit('setTargetListYears', response);
                    resolve(response);
                    setTimeout(() => {
                        commit('setLoadingState', false);
                    }, 1000);
                })
                .catch(error => {
                    reject(error);
                    setTimeout(() => {
                        commit('setLoadingState', 1000);
                    }, 1000);
                });
            });
        },
        storeTargetList: ({commit}, payload) => {
            commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/reports/target-lists', payload)
                .then(response => {
                    setTimeout(() => {
                        commit('setServerResponse', response);
                        commit('setSubmitState', false);
                        toastr.success('Success', response.data.message);
                        resolve(response)
                    }, 1000);
                })
                .catch(error => {
                    commit('setServerResponse', error.response);
                    commit('setSubmitState', false);
                    reject(error)
                });
            });
        },
        updateTargetList: ({commit}, payload) => {
            commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/reports/target-lists/' + payload.id, payload)
                .then(response => {
                    setTimeout(() => {
                        commit('setServerResponse', response);
                        commit('setSubmitState', false);
                        resolve(response)
                        // $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        //document.getElementById('departmentForm').reset();
                    }, 1000);
                })
                .catch(error => {
                    commit('setServerResponse', error.response);
                    commit('setSubmitState', false);
                    reject(error)
                });
            });
        },
        deleteTargetList: ({commit}, payload) => {
            axios.delete('api/reports/target-lists/' + payload.target_list.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                commit('setServerResponse', error.response.data);
                if (error.response.status == 403) {
                    toastr.error('Error', error.response.data);
                }
                console.log(error)
            });
        }
    }
}