<template>
    <form id="sourcingForm" @submit.prevent="submitForm('sourcingForm')" data-vv-scope="sourcingForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.industry_name">
                        <li v-for="e in serverResponse.data.errors.name" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Name</label>
                <input name="name" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="sourcing_practice.name">
                <small class="form-text has-danger" v-show="errors.has('sourcingForm.name')">{{ errors.first('sourcingForm.name') }}</small>
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
                <button type="button" @click="closeModal('sourcingForm')" class="btn btn-sm btn-danger">
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
            sourcing_practice() {
                return this.$store.getters.getSourcingPractice;
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
                        let sourcing_practice = {
                            id: this.sourcing_practice.id,
                            name: this.sourcing_practice.name.toUpperCase()
                        };
                        
                        if (this.formType == 'CREATE_SOURCING_PRACTICE') {
                            this.$store.dispatch('storeSourcingPractice', sourcing_practice).then(() => {
                                this.$store.dispatch('loadSourcingPractices', 'api/maintenance/sourcing_practices');
                            });
                        } else if (this.formType == 'EDIT_SOURCING_PRACTICE') {
                            this.$store.dispatch('updateSourcingPractice', sourcing_practice)
                            .then(() => {
                                this.$store.dispatch('loadSourcingPractices', 'api/maintenance/sourcing_practices');
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
