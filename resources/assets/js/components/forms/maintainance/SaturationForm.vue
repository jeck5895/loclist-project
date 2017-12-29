<template>
    <form id="saturationForm" @submit.prevent="submitForm('saturationForm')" data-vv-scope="saturationForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.saturation_mode">
                        <li v-for="e in serverResponse.data.errors.saturation_mode" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Saturation mode</label>
                <input name="saturation_mode" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="saturation.saturation_mode">
                <small class="form-text has-danger" v-show="errors.has('saturationForm.saturation_mode')">{{ errors.first('saturationForm.saturation_mode') }}</small>
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
                <button type="button" @click="closeModal('saturationForm')" class="btn btn-sm btn-danger">
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
        saturation() {
            return this.$store.getters.getSaturation;
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
                        id: this.saturation.id,
                        saturation_mode: this.saturation.saturation_mode.toUpperCase()
                    };

                    if (this.formType == 'CREATE_SATURATION') {
                            this.$store.dispatch('storeSaturation', department).then(() => {
                                this.$store.dispatch('loadSaturations', 'api/saturations');
                            });
                    } else if (this.formType == 'EDIT_SATURATION') {
                            this.$store.dispatch('updateSaturation', department)
                            .then(() => {
                            this.$store.dispatch('loadSaturations', 'api/saturations');
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
