<template>
    <form id="positionForm" @submit.prevent="submitForm('positionForm')" data-vv-scope="positionForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.position_name">
                        <li v-for="e in serverResponse.data.errors.position_name" :key="e">{{ e }}</li>
                    </ul>
                    <ul v-if="serverResponse.data.errors.department_id">
                        <li v-for="e in serverResponse.data.errors.department_id" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>  

            <div class="form-group col-md-12">
                <label for="">Department</label>
                <select v-model="position.department_id" v-validate="{rules:{required:true}}" name="department" id="department" class="form-control form-control-sm">
                    <option v-for="(department, index) in departments" :key="index" :value="department.id">{{ department.department_name }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('positionForm.department')">{{ errors.first('positionForm.department') }}</small>
            </div>

            <div class="form-group col-md-12">
                <label for="">Position</label>
                <input name="position_name" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="position.position_name">
                <small class="form-text has-danger" v-show="errors.has('positionForm.position_name')">{{ errors.first('positionForm.position_name') }}</small>
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
                <button type="button" @click="closeModal('positionForm')" class="btn btn-sm btn-danger">
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
        departments() {
            return this.$store.getters.getDepartments;
        },
        position() {
            return this.$store.getters.getPosition;
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
                    let position = {
                        id: this.position.id,
                        department_id: this.position.department_id,
                        position_name: this.position.position_name.toUpperCase()
                    };
                    
                    if (this.formType == 'CREATE_POSITION') {
                            this.$store.dispatch('storePosition', position).then(() => {
                                this.$store.dispatch('loadPositions', 'api/maintainance/positions');
                            });
                    } else if (this.formType == 'EDIT_POSITION') {
                            this.$store.dispatch('updatePosition', position)
                            .then(() => {
                            this.$store.dispatch('loadPositions', 'api/maintainance/positions');
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
