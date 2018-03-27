
export default {
    state : {
        pending_task: {},
        pending_tasks : [],
        pending_tasks_is_loading: false,
        pending_task_client_list_is_loading: false,
        pending_task_clients_list: []
    },
    getters : {
        getPendingTask: state => {
            return state.pending_task;
        },
        getPendingTasks : state => {
            return state.pending_tasks;
        },
        getPendingTasksLoadingState : state => {
            return state.pending_tasks_is_loading;
        },
        getPendingTasksClientListLoadingState: state => {
            return state.pending_task_client_list_is_loading;
        },
        getPendingTaskClientList: state => {
            return state.pending_task_clients_list;
        }
    },
    mutations : {
        clearPendingTask: state => {
            state.pending_task = {};
        },
        clearPendingTasks: state => {
            state.pending_tasks = [];
        },
        clearPendingTaskClientList: state => {
            state.pending_task_clients_list = [];
        },
        setPendingTask: (state, payload) => {
            state.pending_task = payload.data;
        },
        setPendingTasks: (state, payload) => {
            state.pending_tasks = payload.data;
        },
        setPendingTasksState: (state, payload) => {
            state.pending_tasks_is_loading = payload;
        },
        setPendingTaskClientListState: (state, payload) => {
            state.pending_task_client_list_is_loading = payload;
        },
        setPendingTaskClientList: (state, payload) => {
            state.pending_task_clients_list = payload.data;
        }
    },
    actions : {
        loadPendingTask: ({commit}, payload) => {
            commit('setPendingTasksState', true);
            commit('clearPendingTask');

            return new Promise((resolve, reject) => {
                axios.get('api/pending-tasks')
                .then(response => {
                    commit('setPendingTask', response);
                    setTimeout(() => {
                        commit('setPendingTasksState', false);
                        resolve(response);
                    }, 100);
                })
                .catch(error => {
                    setTimeout(() => {
                        commit('setPendingTasksState', true);
                        reject(error);
                    }, 100);
                });
            });
        },
        loadPendingTasks: ({commit}, payload) => {
            commit('setPendingTasksState', true);
            commit('clearPendingTasks');

            return new Promise((resolve, reject) => {
                axios.get('api/pending-tasks')
                    .then(response => {
                        commit('setPendingTasks', response);
                        setTimeout(() => {
                            commit('setPendingTasksState', false);
                            resolve(response);
                        }, 100);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            commit('setPendingTasksState', true);
                            reject(error);
                        }, 100);
                    });
            });
        },
        loadPendingTaskClientList: ({commit}, payload) => {
            commit('setPendingTaskClientListState', true);
            commit('clearPendingTaskClientList');

            return new Promise((resolve, reject) => {
                axios.get(`api/pending-tasks/list-of-clients/${payload.scope}/${payload.task_id}/date/${payload.range}`) 
                .then(response => {
                    
                    setTimeout(() => {
                        commit('setPendingTaskClientListState', false);
                        commit('setPendingTaskClientList', response);
                        resolve(response);
                    }, 1000);
                })
                .catch(error => {
                    setTimeout(() => {
                        commit('setPendingTaskClientListState', false);
                        reject(response);
                    }, 1000);
                })
            }); 
        }
    }
};