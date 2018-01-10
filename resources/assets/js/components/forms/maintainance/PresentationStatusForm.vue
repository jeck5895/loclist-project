<template>
    <form id="presentationStatusForm" @submit.prevent="submitForm('presentationStatusForm')" data-vv-scope="presentationStatusForm">
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
                <label for="">Presentation status</label>
                <input name="status" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="presentation_status.status">
                <small class="form-text has-danger" v-show="errors.has('presentationStatusForm.status')">{{ errors.first('presentationStatusForm.status') }}</small>
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
                <button type="button" @click="closeModal('presentationStatusForm')" class="btn btn-sm btn-danger">
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
        presentation_status() {
            return this.$store.getters.getPresentationStatus;
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
    methods:{
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
                    let presentation_status = {
                        id: this.presentation_status.id,
                        status: this.presentation_status.status.toUpperCase()
                    };

                    if (this.formType == 'CREATE_PRESENTATION_STATUS') {
                            this.$store.dispatch('storePresentationStatus', presentation_status).then(() => {
                                this.$store.dispatch('loadPresentationStatuses', 'api/maintainance/presentation-statuses');
                            });
                    } else if (this.formType == 'EDIT_PRESENTATION_STATUS') {
                            this.$store.dispatch('updatePresentationStatus', presentation_status)
                            .then(() => {
                            this.$store.dispatch('loadPresentationStatuses', 'api/maintainance/presentation-statuses');
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
