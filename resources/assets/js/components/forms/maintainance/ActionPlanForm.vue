<template>
    <form id="actionPlanForm" @submit.prevent="submitForm('actionPlanForm')" data-vv-scope="actionPlanForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.action_name">
                        <li v-for="e in serverResponse.data.errors.action_name" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Action Plan</label>
                <input name="action_name" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="action_plan.action_name">
                <small class="form-text has-danger" v-show="errors.has('actionPlanForm.action_name')">{{ errors.first('actionPlanForm.action_name') }}</small>
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
                <button type="button" @click="closeModal('actionPlanForm')" class="btn btn-sm btn-danger">
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
        action_plan() {
            return this.$store.getters.getActionPlan;
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
                    let action_plan = {
                        id: this.action_plan.id,
                        saturation_mode: this.action_plan.action_name.toUpperCase()
                    };

                    if (this.formType == 'CREATE_ACTION_PLAN') {
                            this.$store.dispatch('storeActionPlan', action_plan).then(() => {
                                this.$store.dispatch('loadActionPlans', 'api/action-plans');
                            });
                    } else if (this.formType == 'EDIT_ACTION_PLAN') {
                            this.$store.dispatch('updateActionPlan', action_plan)
                            .then(() => {
                            this.$store.dispatch('loadActionPlans', 'api/action-plans');
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
