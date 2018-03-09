export default {
    state : {
        action_plans: [],
        action_plan: {}
    },
    getters: {
        getActionPlans: state => {
            return state.action_plans;
        },
        getActionPlan: state => {
            return state.action_plan;
        }
    },
    mutations: {
        clearActionPlans: state => {
            state.action_plans = [];
        },
        clearActionPlan: state => {
            state.action_plan = {};
        },
        setActionPlans: (state, payload) => {
            state.action_plans = payload.data;
        },
        setActionPlan: (state, payload) => {
            state.action_plan = payload.data;
        }
    },
    actions: {
        clearActionPlans: context => {
            context.commit('clearActionPlans');
        },
        clearActionPlan: context => {
            context.commit('clearActionPlan');
        },
        loadActionPlans: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setActionPlans', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
                console.log(error.response)
            });
        },
        loadActionPlan: (context, payload) => {
            axios.get('api/maintenance/action-plans/' + payload.id)
            .then(response => {
                context.commit('setActionPlan', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        storeActionPlan: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/action-plans', payload)
                .then(response => {
                    setTimeout(() => {
                        resolve(response);
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        //document.getElementById('departmentForm').reset();
                    }, 1000);
                })
                .catch(error => {
                    reject(error);
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                });
            });
        },
        updateActionPlan: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/action-plans/' + payload.id, payload)
                .then(response => {
                    setTimeout(() => {
                        resolve(response);
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        $("#createUserModal").modal('hide');
                        toastr.success('Success', response.data.message);
                        //document.getElementById('departmentForm').reset();
                    }, 1000);
                })
                .catch(error => {
                    reject(error);
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                });
            });
        },
        deleteActionPlan: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/action-plans/' + payload.action_plan.id)
                .then(response => {
                    resolve(response)
                    toastr.success('Success', response.data.message);
                })
                .catch(error => {
                    reject(error);
                    context.commit('setServerResponse', error.response.data);
                    if(error.response.status == 403){
                        toastr.error('Error', error.response.data);
                    }
                    //toastr.error('Forbidden')
                    console.log(error.response)
                });
            });
        }
    }
}