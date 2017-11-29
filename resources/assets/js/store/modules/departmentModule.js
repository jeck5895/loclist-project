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
            axios.get(payload)
            .then(response => {
                context.commit('setDepartments', response);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        loadDepartment: (context, payload) => {
            axios.get('api/departments/' + payload.id)
            .then(response => {
                context.commit('setDepartment', response);
            })
            .catch(error => {
                console.log(error.response)
            });
        },
        storeDepartment: (context, payload) => {
            axios.post('api/departments', payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('departmentForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
            });
        },
        updateDepartment: (context, payload) => {
            axios.patch('api/departments/' + payload.id, payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('departmentForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
            });
        },
        deleteDepartment: (context, payload) => {
            axios.delete('api/departments/' + payload.department.id)
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