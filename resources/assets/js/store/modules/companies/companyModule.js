export default {
    state: {
        companies: [],
        company: {}
    },
    getters: {
        getCompany: state => {
            return state.company;
        },
        getCompanies: state => {
            return state.companies;
        }
    },
    mutations: {
        clearCompany: state => {
            state.company = {};
        },
        clearCompanies: state => {
            state.companies = [];
        },
        setCompany: (state, payload) => {
            state.company = payload.data;
        },
        setCompanies: (state, payload) => {
            state.companies = payload.data;
        }
    },
    actions: {
        clearCompany: context => {
            context.commit('clearCompany')
        }, 
        clearCompanies: context => {
            context.commit('clearCompanies');
        },
        loadCompany: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/companies/' + payload.id)
                    .then(response => {
                        context.commit('setCompany', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        toastr.error('Error', error.response.data);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error)
                        }, 1000);
                    });
            });
        },
        loadCompanies: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setCompanies', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch(error => {
                        toastr.error('Error', 'Please contact the System Administrator');
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error)
                        }, 1000);
                        console.log(error.response);
                    });
            });
        },
        storeCompany: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/companies', payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            toastr.success('Success', response.data.message);
                            $("#createUserModal").modal('hide');
                            resolve(response)
                            // document.getElementById('companyForm').reset();   
                        }, 1000);
                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setServerResponse', error.response);
                            context.commit('setSubmitState', false);
                            reject(error)
                        });
                    });
            })
        },
        updateCompany: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/companies/' + payload.id, payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            toastr.success('Success', response.data.message);
                            $("#createUserModal").modal('hide');
                            resolve(response)
                            // document.getElementById('companyForm').reset();   
                        }, 1000);
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response);
                        setTimeout(() => {
                            context.commit('setSubmitState', false);
                            reject(error)
                        }, 1000);
                        console.log(error.response.data)
                    })
            });
        },
        deleteCompany: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/companies/' + payload.company.id)
                    .then(response => {
                        toastr.success('Success', response.data.message)
                        resolve(response)
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response);
                        if (error.response.status == 403) {
                            toastr.error('Error', error.response.data);
                        }
                        reject(error)
                    });
            });
        }
    }
}