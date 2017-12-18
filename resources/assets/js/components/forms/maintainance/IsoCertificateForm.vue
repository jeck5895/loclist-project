<template>
    <form id="isoForm" @submit.prevent="submitForm('isoForm')" data-vv-scope="isoForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.iso_name">
                        <li v-for="e in serverResponse.data.errors.iso_name" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">ISO name</label>
                <input name="certificate" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="certificate.iso_name">
                <small class="form-text has-danger" v-show="errors.has('isoForm.certificate')">{{ errors.first('isoForm.certificate') }}</small>
            </div>

            <div class="form-group col">
                <button type="submit" class="btn btn-success btn-sm" :disabled="isSubmitting">
                    <span v-if="isSubmitting">
                        Saving... <div class="loading"></div>
                    </span>
                    <span v-else>
                        Save
                    </span>
                </button>
                <button type="button" @click="closeModal('isoForm')" class="btn btn-sm btn-danger">
                    Close
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        created() {

        },
        computed: {
            isSubmitting() {
                return this.$store.getters.getSubmitState;
            },
            certificate() {
                return this.$store.getters.getIsoCertificate;
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
                this.$validator.validateAll(scope).then((result) => {
                    if (result) { // if true submit form else set serverResponse error
                        let certificate = {
                            id: this.certificate.id,
                            iso_name: this.certificate.iso_name.toUpperCase()
                        };
                        
                        if (this.formType == 'CREATE_ISO') {
                            this.$store.dispatch('storeCertificate', certificate).then(() => {
                                this.$store.dispatch('loadCertificates', 'api/certificates');
                            });
                        } else if (this.formType == 'EDIT_ISO') {
                            this.$store.dispatch('updateCertificate', certificate)
                            .then(() => {
                                this.$store.dispatch('loadCertificates', 'api/certificates');
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
