<template>
    <form id="departmentForm" @submit.prevent="submitForm('departmentForm')" data-vv-scope="departmentForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.department_name">
                        <li v-for="e in serverResponse.data.errors.department_name" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">Department</label>
                <input name="department_name" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="uppercase form-control form-control-sm"
                    v-model="department.department_name">
                <small class="form-text has-danger" v-show="errors.has('departmentForm.department_name')">{{ errors.first('departmentForm.department_name') }}</small>
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
                <button type="button" @click="closeModal('departmentForm')" class="btn btn-sm btn-danger">
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
        department() {
            return this.$store.getters.getDepartment;
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
                        id: this.department.id,
                        department_name: this.department.department_name.toUpperCase()
                    };

                    if (this.formType == 'CREATE_DEPARTMENT') {
                            this.$store.dispatch('storeDepartment', department).then(() => {
                                this.$store.dispatch('loadDepartments', 'api/departments');
                            });
                    } else if (this.formType == 'EDIT_DEPARTMENT') {
                            this.$store.dispatch('updateDepartment', department)
                            .then(() => {
                            this.$store.dispatch('loadDepartments', 'api/departments');
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
