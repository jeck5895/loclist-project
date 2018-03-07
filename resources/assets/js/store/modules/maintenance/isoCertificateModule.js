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
            axios.get(payload)
            .then(response => {
                context.commit('setIsoCertificates',response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
                console.log(error.response.data)
            });
        },
        loadCertificate: (context, payload) => {
            axios.get('api/maintainance/certificates/' + payload.id)
            .then(response => {
                context.commit('setIsoCertificate', response);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response.data)
            });
        },
        storeCertificate: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.post('api/maintainance/certificates', payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('isoForm').reset();
                }, 1000);
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                context.commit('setSubmitState', false);
                //toastr.error('Error', 'Oops! something went wrong');
                console.log(errors);
            });
        },
        updateCertificate: (context, payload) => {
            context.commit('setSubmitState', true);
            axios.patch('api/maintainance/certificates/' + payload.id, payload)
            .then(response => {
                setTimeout(() => {
                    context.commit('setServerResponse', response);
                    context.commit('setSubmitState', false);
                    $("#createUserModal").modal('hide');
                    toastr.success('Success', response.data.message);
                    //document.getElementById('isoForm').reset();
                }, 1000);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                context.commit('setSubmitState', false);
                console.log(error.response)
            });
        },
        deleteCertificate: (context, payload) => {
            axios.delete('api/maintainance/certificates/' + payload.certificate.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response.data);
                if (error.response.status == 403) {
                    toastr.error('Error', error.response.data);
                }
            });
        }
    }
}