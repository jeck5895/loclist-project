<template>
    <form id="statusForm" @submit.prevent="submitForm('statusForm')" data-vv-scope="statusForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.status">
                        <li v-for="e in serverResponse.data.errors.status" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Name</label>
                <input name="name" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="status.status">
                <small class="form-text has-danger" v-show="errors.has('statusForm.status')">{{ errors.first('statusForm.status') }}</small>
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
                <button type="button" @click="closeModal('statusForm')" class="btn btn-sm btn-danger">
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
            status() {
                return this.$store.getters.getStatus;
            },
            isSubmitting() {
                return this.$store.getters.getSubmitState;
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
                        let status = {
                            id: this.status.id,
                            status: this.status.status.toUpperCase()
                        };

                        if (this.formType == 'CREATE_STATUS') {
                            this.$store.dispatch('storeStatus', status).then(() => {
                                this.$store.dispatch('loadStatuses', 'api/maintenance/statuses');
                            });
                        } else if (this.formType == 'EDIT_STATUS') {
                            this.$store.dispatch('updateStatus', status)
                                .then(() => {
                                    this.$store.dispatch('loadStatuses', 'api/maintenance/statuses');
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