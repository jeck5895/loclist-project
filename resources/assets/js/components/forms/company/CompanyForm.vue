<template>
    <form id="companyForm" @submit.prevent="submitForm('companyForm')" data-vv-scope="companyForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors">
                        <li v-if="serverResponse.data.errors.company_name" v-for="e in serverResponse.data.errors.company_name" :key="e">{{ e }}</li>
                        <li v-if="serverResponse.data.errors.code" v-for="e in serverResponse.data.errors.code" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Company</label>
                <input name="company_name" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm"
                    v-model="company.company_name">
                <small class="form-text has-danger" v-show="errors.has('companyForm.company_name')">{{ errors.first('companyForm.company_name') }}</small>
            </div>
            <div class="form-group col-md-12">
                <label for="">Code</label>
                <input name="code" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm"
                    v-model="company.code">
                <small class="form-text has-danger" v-show="errors.has('companyForm.code')">{{ errors.first('companyForm.code') }}</small>
            </div>

            <div class="form-group col">
                <button type="submit" class="btn btn-sm btn-success">Save</button>
                <button type="button" @click="closeModal('companyForm')" class="btn btn-sm btn-danger">
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
            company() {
                return this.$store.getters.getCompany;
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
                let company = {
                    id: this.company.id,
                    company_name: this.company.company_name,
                    code: this.company.code
                }
                this.$validator.validateAll(scope).then((result) => {
                    if (result) { // if true submit form else set serverResponse error
                        if (this.formType == 'CREATE_COMPANY') {
                            this.$store.dispatch('storeCompany', company).then(() => {
                                this.$store.dispatch('loadCompanies', 'api/companies');
                            });
                        } else if (this.formType == 'EDIT_COMPANY') {
                            this.$store.dispatch('updateCompany', company)
                            .then(() => {
                                this.$store.dispatch('loadCompanies', 'api/companies');
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