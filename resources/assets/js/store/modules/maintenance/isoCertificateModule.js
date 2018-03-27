export default {
    state: {
        isoCertificate: {},
        isoCertificates: [],
    },
    getters: {
        getIsoCertificate: state => {
            return state.isoCertificate;
        },
        getIsoCertificates: state => {
            return state.isoCertificates;
        }
    },
    mutations: {
        clearIsoCertificates: state => {
            state.isoCertificates = [];
        },
        clearCertificate: state => {
            state.isoCertificate = {};
        },
        setIsoCertificate: (state, payload) => {
            state.isoCertificate = payload.data;
        },
        setIsoCertificates: (state, payload) => {
            state.isoCertificates = payload.data;
        }
    },
    actions: {
        clearIsoCertificates: context => {
            context.commit('clearIsoCertificates');
        },
        clearIsoCertificate: context => {
            var {commit} = context; //es6 destructuring method
            commit('clearCertificate');
        },
        loadCertificates: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get(payload)
                    .then(response => {
                        context.commit('setIsoCertificates', response);
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
        loadCertificate: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/maintenance/certificates/' + payload.id)
                    .then(response => {
                        context.commit('setIsoCertificate', response);
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
        storeCertificate: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.post('api/maintenance/certificates', payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response);
                            //document.getElementById('isoForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        let errors = error.response;
                        context.commit('setServerResponse', errors);
                        context.commit('setSubmitState', false);
                        reject(error)
                        //toastr.error('Error', 'Oops! something went wrong');
                        console.log(errors);
                    });
            })
        },
        updateCertificate: (context, payload) => {
            context.commit('setSubmitState', true);
            return new Promise((resolve, reject) => {
                axios.patch('api/maintenance/certificates/' + payload.id, payload)
                    .then(response => {
                        setTimeout(() => {
                            context.commit('setServerResponse', response);
                            context.commit('setSubmitState', false);
                            $("#createUserModal").modal('hide');
                            toastr.success('Success', response.data.message);
                            resolve(response)
                            //document.getElementById('isoForm').reset();
                        }, 1000);
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response);
                        context.commit('setSubmitState', false);
                        reject(error);
                        console.log(error.response)
                    });
            })
        },
        deleteCertificate: (context, payload) => {
            return new Promise((resolve, reject) => {
                axios.delete('api/maintenance/certificates/' + payload.certificate.id)
                    .then(response => {
                        toastr.success('Success', response.data.message);
                        resolve(response)
                    })
                    .catch(error => {
                        context.commit('setServerResponse', error.response.data);
                        if (error.response.status == 403) {
                            toastr.error('Error', error.response.data);
                        }
                        reject(reject)
                    });
            });
        }
    }
}