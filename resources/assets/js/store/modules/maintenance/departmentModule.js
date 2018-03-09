export default {
    state:{
        department: {},
        departments: []
    },
    getters: {
        getDepartment: state => {
            return state.department;
        },
        getDepartments : state => {
            return state.departments;
        }
    },
    mutations: {
        clearDepartment: state => {
            state.department = {};
        },
        clearDepartments: state => {
            state.departments = [];
        },
        setDepartment: (state, payload) => {
            state.department = payload.data;
        },
        setDepartments: (state, payload) => {
            state.departments = payload.data;
        }
    },
    actions:{
        clearDepartment: context => {
            context.commit('clearDepartment');
        },
        clearDepartments: context => {
            context.commit('clearDepartments');
        },
        loadDepartments: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                context.commit('setDepartments', response);
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
        loadDepartment: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get('api/maintenance/departments/' + payload.id)
            .then(response => {
                context.commit('setDepartment', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            });
        },
        storeDepartment: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.post('api/maintenance/departments', payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('departmentForm').reset();
                }, 1000);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                context.commit('setSubmitState', false);
            });
        },
        updateDepartment: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.patch('api/maintenance/departments/' + payload.id, payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('departmentForm').reset();
                }, 1000);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                context.commit('setSubmitState', false);
            });
        },
        deleteDepartment: (context, payload) => {
            axios.delete('api/maintenance/departments/' + payload.department.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response.data);
                if (error.response.status == 403) {
                    toastr.error('Error', error.response.data);
                }
                console.log(error)
            });
        }
    }
}