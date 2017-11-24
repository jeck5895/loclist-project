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
        }
    },
    actions:{
        loadIndustry: () => {

        },
        loadIndustries: context => {
            axios.get('api/industries')
                .then(response => {
                    console.log(response);
                    //ar pages = Math.round(response.data.total / response.data.per_page);
                    context.commit('setIndustries', response);
                    //context.commit('setTotalPage', pages);
                })
                .catch(error => {
                    console.log(error.response.data)
                });
        },
        createIndustry: (context, payload) => {
            axios.post('api/industries', payload)
            .then(response => {
                let result = response;
                context.commit('setServerResponse', result);
                $("#createUserModal").modal('hide');
                toastr.success('Success', result.data.message);
                document.getElementById('industryForm').reset();
            })
            .catch(error => {
                let errors = error.response;
                context.commit('setServerResponse', errors);
                //toastr.error('Error', 'Oops! something went wrong');
                console.log(errors);
            });
        },
        updateIndustry: (context, payload) => {
            alert('edit industry')
        }
    }
};