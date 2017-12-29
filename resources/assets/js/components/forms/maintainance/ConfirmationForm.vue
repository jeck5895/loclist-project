<template>
    <form id="confirmationForm" @submit.prevent="submitForm('confirmationForm')" data-vv-scope="confirmationForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.confirmation_name">
                        <li v-for="e in serverResponse.data.errors.confirmation_name" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Confirmation code</label>
                <input name="saturation_mode" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="confirmation.confirmation_name">
                <small class="form-text has-danger" v-show="errors.has('confirmationForm.confirmation_name')">{{ errors.first('confirmationForm.confirmation_name') }}</small>
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
                <button type="button" @click="closeModal('confirmationForm')" class="btn btn-sm btn-danger">
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
        confirmation() {
            return this.$store.getters.getConfirmation;
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
                    let department = {
                        id: this.confirmation.id,
                        confirmation_name: this.confirmation.confirmation_name.toUpperCase()
                    };

                    if (this.formType == 'CREATE_CONFIRMATION') {
                            this.$store.dispatch('storeConfirmation', department).then(() => {
                                this.$store.dispatch('loadConfirmations', 'api/confirmations');
                            });
                    } else if (this.formType == 'EDIT_CONFIRMATION') {
                            this.$store.dispatch('updateConfirmation', department)
                            .then(() => {
                            this.$store.dispatch('loadConfirmations', 'api/confirmations');
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
