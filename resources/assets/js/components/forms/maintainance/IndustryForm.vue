<template>
    <form id="industryForm" @submit.prevent="submitForm('industryForm')" data-vv-scope="industryForm">
        <div class="row">
            <div class="col-md-12">
               
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors">
                        <template v-if="serverResponse.data.errors.industry_name">
                            <li v-for="e in serverResponse.data.errors.industry_name" :key="e">{{ e }}</li>
                        </template>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Industry</label>
                <input name="industry_name" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm"
                    v-model="industry.industry_name">
                <small class="form-text has-danger" v-show="errors.has('industryForm.industry_name')">{{ errors.first('industryForm.industry_name') }}</small>
            </div>

            <div class="form-group col">
                <button type="submit" class="btn btn-sm btn-success">Save</button>
                <button type="button" @click="closeModal('industryForm')" class="btn btn-sm btn-danger">
                    Close
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {

        },
        computed: {
            industry() {
                return this.$store.getters.getIndustry;
            },
            formType() {
                return this.$store.getters.getModalFormType;
            },
            modalFormValidation() {
                return this.$store.getters.getModalFormValidation;
            },
            serverResponse() {
                return this.$store.getters.getServerResponse;
            }
        },
        methods: {
            closeModal(scope) {
                let payload = {
                    scope: scope,
                    errors: this.errors
                };
                this.$store.dispatch('setModalFormValidation', payload).then(() => {
                    this.$store.dispatch('closeModal', this.modalFormValidation);
                });

            },
            submitForm(scope) {
                let industry = {
                    id: this.industry.id,
                    industry_name: this.industry.industry_name
                }
                this.$validator.validateAll(scope).then((result) => {
                    if (result) { // if true submit form else set serverResponse error
                        if (this.formType == 'CREATE_INDUSTRY') {
                            this.$store.dispatch('storeIndustry', industry).then(() => {
                                this.$store.dispatch('loadIndustries', 'api/industries');
                            });
                        } else if (this.formType == 'EDIT_INDUSTRY') {
                            this.$store.dispatch('updateIndustry', industry)
                            .then(() => {
                                this.$store.dispatch('loadIndustries', 'api/industries');
                            });
                        } else {
                            toastr.error('Error', 'Unknown Command');
                        }
                    } else {

                    }
                });
            }
        }
    }
</script>

<style>

</style>