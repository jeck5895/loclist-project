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
            axios.get(payload)
            .then(response => {
                context.commit('setIsoCertificates',response)
            })
            .catch(error => {
                console.log(error.response.data)
            });
        },
        loadCertificate: (context, payload) => {
            axios.get('api/certificates/' + payload.id)
            .then(response => {
                context.commit('setIsoCertificate', response)
            })
            .catch(error => {
                console.log(error.response.data)
            });
        },
        storeCertificate: (context, payload) => {
            axios.post('api/certificates', payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('isoForm').reset();
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                //toastr.error('Error', 'Oops! something went wrong');
                console.log(errors);
            });
        },
        updateCertificate: (context, payload) => {
            axios.patch('api/certificates/' + payload.id, payload)
            .then(response => {
                context.commit('setServerResponse', response);
                $("#createUserModal").modal('hide');
                toastr.success('Success', response.data.message);
                document.getElementById('isoForm').reset();
            })
            .catch(error => {
                context.commit('setServerResponse', error.response);
                console.log(error.response)
            });
        },
        deleteCertificate: (context, payload) => {
            axios.delete('api/certificates/' + payload.certificate.id)
            .then(response => {
                toastr.success('Success', response.data.message);
            })
            .catch(error => {
                context.commit('setServerResponse', error.response.data);
            });
        }
    }
}