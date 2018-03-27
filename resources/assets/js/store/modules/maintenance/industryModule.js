export default {
    state:{
        industry:{},
        industries:[]
    },
    getters:{
        getIndustry: (state) => {
            return state.industry;
        },
        getIndustries: (state) => {
            return state.industries;
        },
    },
    mutations:{
        setIndustry: (state, payload) => {
            state.industry = payload.data;
        },
        setIndustries: (state, payload) => {
            state.industries = payload.data;
        },
        clearIndustries : state => {
            state.industries = [];
        },
        clearIndustry: state => {
            state.industry = {};
        }
    },
    actions:{
        clearIndustries: context => {
            context.commit('clearIndustries');
        },
        clearIndustry: context => {
            context.commit('clearIndustry');
        },
        loadIndustry: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/industries/' + payload.id)
                    .then((response) => {
                        context.commit('setIndustry', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);
                    })
                    .catch((errors) => {
                        context.commit('setLoadingState', false);
                        reject(errors)
                        console.log(errors.response.data);
                    });
            });
        },
        loadIndustries: (context, payload) => { /** payload is used for url pagination. So url is dynamic */
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {

                        context.commit('setIndustries', response);
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            resolve(response)
                        }, 1000);

                    })
                    .catch(error => {
                        setTimeout(() => {
                            context.commit('setLoadingState', false);
                            reject(error)
                        }, 1000);
                        console.log(error.response.data)
                    });
            });
        },
        storeIndustry: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/industries', payload)
                    .then(response => {
                        let result = response;
                        setTimeout(() => {
                            context.commit('setServerResponse', result);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', result.data.message);
                            resolve(response);
                            //document.getElementById('industryForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        let errors = error.response;
                        context.commit('setServerResponse', errors);
                        context.commit('setSubmitState', false);
                        reject(error);
                        //toastr.error('Error', 'Oops! something went wrong');
                        console.log(errors);
                    });
            });
        },
        updateIndustry: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/industries/' + payload.id, payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', result.data.message);
                            resolve(response)
                            //document.getElementById('industryForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response);
                        context.commit('setSubmitState', false);
                        reject(error)
                        console.log(error.response.data)
                    })
            });
        },
        deleteIndustry: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/industries/' + payload.industry.id)
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
                        console.log(error)
                    });
            })
        }
    }
};