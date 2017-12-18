<template>
    <form id="manpowerForm" @submit.prevent="submitForm('manpowerForm')" data-vv-scope="manpowerForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.type">
                        <li v-for="e in serverResponse.data.errors.type" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Type</label>
                <input name="type" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="manpower.type">
                <small class="form-text has-danger" v-show="errors.has('manpowerForm.type')">{{ errors.first('manpowerForm.type') }}</small>
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
                <button type="button" @click="closeModal('manpowerForm')" class="btn btn-sm btn-danger">
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
            isSubmitting() {
                return this.$store.getters.getSubmitState;
            },
            manpower() {
                return this.$store.getters.getManpower;
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
                        
                        let manpower = {
                            id: this.manpower.id,
                            type: this.manpower.type.toUpperCase()
                        };

                        if (this.formType == 'CREATE_MANPOWER') {
                            this.$store.dispatch('storeManpower', manpower).then(() => {
                                this.$store.dispatch('loadManpowers', 'api/manpowers');
                            });
                        } else if (this.formType == 'EDIT_MANPOWER') {
                            this.$store.dispatch('updateManpower', manpower)
                            .then(() => {
                                this.$store.dispatch('loadManpowers', 'api/manpowers');
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
