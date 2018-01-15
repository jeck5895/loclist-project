<template>
    <form id="acquisitionForm" @submit.prevent="submitForm('acquisitionForm')" data-vv-scope="acquisitionForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.acquisition_name">
                        <li v-for="e in serverResponse.data.errors.acquisition_name" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Acquisition code</label>
                <input name="saturation_mode" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="acquisition.acquisition_name">
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.acquisition_name')">{{ errors.first('acquisitionForm.acquisition_name') }}</small>
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
                <button type="button" @click="closeModal('acquisitionForm')" class="btn btn-sm btn-danger">
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
        acquisition() {
            return this.$store.getters.getAcquisition;
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
                        id: this.acquisition.id,
                        acquisition_name: this.acquisition.acquisition_name.toUpperCase()
                    };

                    if (this.formType == 'CREATE_ACQUISITION') {
                            this.$store.dispatch('storeAcquisition', department).then(() => {
                                this.$store.dispatch('loadAcquisitions', 'api/maintainance/acquisitions');
                            });
                    } else if (this.formType == 'EDIT_ACQUISITION') {
                            this.$store.dispatch('updateAcquisition', department)
                            .then(() => {
                            this.$store.dispatch('loadAcquisitions', 'api/maintainance/acquisitions');
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
