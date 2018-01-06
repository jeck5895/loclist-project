<template>
    <form id="modeOfPresentationForm" @submit.prevent="submitForm('modeOfPresentationForm')" data-vv-scope="modeOfPresentationForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.presentation_mode">
                        <li v-for="e in serverResponse.data.errors.presentation_mode" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Presentation mode</label>
                <input name="presentation_mode" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="mode_of_presentation.presentation_mode">
                <small class="form-text has-danger" v-show="errors.has('modeOfPresentationForm.presentation_mode')">{{ errors.first('modeOfPresentationForm.presentation_mode') }}</small>
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
                <button type="button" @click="closeModal('modeOfPresentationForm')" class="btn btn-sm btn-danger">
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
        mode_of_presentation() {
            return this.$store.getters.getModeOfPresentation;
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
                    let mode_of_presentation = {
                        id: this.mode_of_presentation.id,
                        saturation_mode: this.mode_of_presentation.presentation_mode.toUpperCase()
                    };

                    if (this.formType == 'CREATE_MODE_OF_PRESENTATION') {
                            this.$store.dispatch('storeModeOfPresentation', mode_of_presentation).then(() => {
                                this.$store.dispatch('loadModeOfPresentations', 'api/mode-of-presentations');
                            });
                    } else if (this.formType == 'EDIT_MODE_OF_PRESENTATION') {
                            this.$store.dispatch('updateModeOfPresentation', mode_of_presentation)
                            .then(() => {
                            this.$store.dispatch('loadModeOfPresentations', 'api/mode-of-presentations');
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
