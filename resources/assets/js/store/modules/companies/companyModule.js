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
            axios.get('api/companies/' + payload.id)
            .then( response => {
                context.commit('setCompany', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                },1000);
            })
            .catch(error => {
                toastr.error('Error', error.response.data);
            });
        },
        loadCompanies: (context, payload) => {
            axios.get(payload)
            .then( response => {
                context.commit('setCompanies', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch( error => {
                toastr.error('Error','Please contact the System Administrator');
                console.log(error.response);
            });
        },
        storeCompany: (context, payload) => {
            axios.post('api/companies', payload)
            .then( response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    toastr.success('Success', response.data.message);
                    $("#createUserModal").modal('hide');
                    // document.getElementById('companyForm').reset();   
                }, 1000);
            })
            .catch(error => {
                setTimeout(() => {
                    context.commit('setServerResponse', error.response);
                    context.commit('setSubmitState', false);
                });
            });
        },
        updateCompany: (context, payload) => {
            axios.patch('api/companies/' + payload.id, payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('companyForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                console.log(error.response.data)
            })
        },
        deleteCompany: (context, payload) => {
            axios.delete('api/companies/' + payload.company.id)
            .then( response => {
                toastr.success('Success', response.data.message)
            })
            .catch( error => {
                context.commit('setServerResponse', error.response);
            });
        }
    }
}