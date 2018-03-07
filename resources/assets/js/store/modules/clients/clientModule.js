
export default {
    state:{
        clients: [],
        client: {},
        client_manpower_providers: [],
        client_manpower_provider: {},
        client_sourcing_practices: [],
        client_sourcing_practice: {},
        contact_persons: [],
    },
    getters:{
        getClients: state => {
            return state.clients;
        },
        getClient: state => {
            return state.client;
        },
        getClientManpowerProviders: state => {
            return state.client_manpower_providers;
        },
        getClientManpowerProvider: state => {
            return state.client_manpower_provider;
        },
        getClientSourcingPractices: state => {
            return state.client_sourcing_practices;
        },  
        getClientSourcingPractice: state => {
            return state.client_sourcing_practice;
        },
        getClientContactPersons: state => {
            return state.contact_persons;
        },
        getClientContactPerson: state => {
            return state.contact_person;
        }
    },
    mutations:{
        clearClient: state => {
            state.client = {};
        },
        clearClients: state => {
            state.clients = [];
        },
        clearClientManpowerProviders: state => {
            state.client_manpower_providers = [];
        },
        clearContactPersons: state => {
            state.contact_persons = [];
        },
        removeClientManpowerProvider: (state, payload) => {
            state.client_manpower_providers.splice(state.client_manpower_providers.indexOf(payload), 1);
        },
        removeContactPerson: (state, payload) => {
            state.contact_persons.splice(payload, 1);
        },
        setClients: (state, payload) => {
            state.clients = payload.data.model;
        },
        setClient: (state, payload) => {
            state.client = payload.data;
        },
        setClientManpowerProviders: (state, payload) => {
            state.client_manpower_providers.push(payload);
        },
        setClientManpowerProvider: (state, payload) => {
            state.client_manpower_provider = payload;
        },
        setClientSourcingPractices: (state, payload) => {
            state.client_sourcing_practices = payload;
        },
        setContactPersons: (state, payload) => {
            state.contact_persons.push(payload);
        }
    },
    actions:{
        /* This where asynchronous/ajax calls perform and call mutation methods to assign response to state */
        clearClient: context => {
            context.commit('clearClient');
        },
        clearClients: context => {
            context.commit('clearClients');
        },
        clearClientManpowerProviders: context => {
            context.commit('clearClientManpowerProviders');
        },
        clearContactPersons : context => {
            context.commit('clearContactPersons');
        },
        loadClient: (context, payload) => {
            context.commit('setLoadingState', true);
            context.commit('clearClientManpowerProviders');
            context.commit('clearContactPersons');

            axios.get('api/clients/' + payload.id)
            .then(response => {
                //let sourcing_practices = response.data.sourcing_practices;
                let client_manpower_providers = response.data.manpower_providers;
                let client_contact_persons = response.data.contact_persons;
                // let selected_arr = [];
                
                client_manpower_providers.map((item) => {
                    context.commit('setClientManpowerProviders', item.manpower_provider);
                });

                if(client_contact_persons.lenght != 0){
                    client_contact_persons.map((item) => {
                        let payload = {
                            first_name: item.first_name,
                            last_name: item.last_name,
                            gender: item.gender,
                            mobile_number: item.mobile_number,
                            email: item.email,
                            department:{
                                id: item.department.id,
                                department_name: item.department.department_name
                            },
                            position: {
                                id: item.position.id,
                                position_name: item.position.position_name
                            }
                        }
                        context.commit('setContactPersons', payload);
                    });
                }
               
                // sourcing_practices.map((item) => {
                //     selected_arr.push(item.id);
                // });
                
                context.commit('setClient', response);
                // context.commit('setClientSourcingPractices', selected_arr);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response);
            });
        },
        loadClients: (context, payload) => {
            context.commit('setLoadingState', true);
            axios.get(payload)
            .then(response => {
                console.log(response)
                context.commit('setClients', response);
                context.commit('setColumns', response.data.columns);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            })
            .catch(error => {
                console.log(error.response.data);
                setTimeout(() => {
                    context.commit('setLoadingState', false);
                }, 1000);
            });
        },
        removeClientManpowerProvider: (context, payload) => {
            context.commit('removeClientManpowerProvider', payload);
        },
        storeClientManpowerProviders: (context, payload) => {
            context.commit('setClientManpowerProviders', payload)
        },
        removeContactPerson: ({commit}, payload) => {
            commit('removeContactPerson', payload);
        },
        storeContactPerson: ({commit}, payload) => {
            commit('setContactPersons', payload);
        },
        storeClient: (context, payload) => {
            
            context.commit('setSubmitState', true);

            return new Promise((resolve, reject) => {
                axios.post('api/clients', payload)
                .then(response => {
                    setTimeout(() => {
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        toastr.success('Success', response.data.message);
                        resolve(response)
                    }, 2000);
                })
                .catch(error => {
                    setTimeout(() => {
                        context.commit('setServerResponse', error.response);
                        context.commit('setSubmitState', false);
                        reject(error.response)
                    }, 2000);
                });
            })
        },
        updateClient: (context, payload) => {

            context.commit('setSubmitState', true);
            
            return new Promise((resolve, reject) => {
                axios.patch('api/clients/' + payload.id, payload)
                .then( response => {
                    setTimeout(() => {
                        context.commit('setServerResponse', response);
                        context.commit('setSubmitState', false);
                        toastr.success('Success', response.data.message);
                        resolve(response)
                    }, 2000);
                })
                .catch(error => {
                    setTimeout(() => {
                        context.commit('setSubmitState', false);
                        context.commit('setServerResponse', error.response);
                        reject(error.response)
                    }, 2000);
                })
            });
        },
        deleteClient: (context, payload) => {
            axios.delete('api/clients/', + payload.id)
            .then( response => {
                toastr.success('Success', response.data.message)
            })
            .catch( error => {
                context.commit('setServerResponse', error.response);
            });
        },
        search: (context, payload) => {
            context.commit('setLoadingState', true);
            return new Promise((resolve, reject) => {
                axios.get('api/clients/search?keyword=' + payload.keyword + '&from_date=' + payload.from_date + '&to_date=' + payload.to_date + '&location=' + payload.location + '&status=' + payload.status + '&industry=' + payload.industry )
                .then(response => {
                    console.log(response)
                    setTimeout(() => {
                        context.commit('setClients', response);
                        context.commit('setLoadingState', false);
                        resolve(response)
                    }, 1000);
                })
                .catch(error => {
                    console.log(error.response)
                    setTimeout(() => {
                        context.commit('setLoadingState', false);
                        reject(error.response)
                    }, 1000);
                });
            });
        }
    }
}