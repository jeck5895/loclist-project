<template>
    <form id="userTypeForm" @submit.prevent="submitForm('userTypeForm')" data-vv-scope="userTypeForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors.userType">
                        <li v-for="e in serverResponse.data.errors.userType" :key="e">{{ e }}</li>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="">User type</label>
                <input name="userType" data-vv-validate-on="'blur'" v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm"
                    v-model="user_type.userType">
                <small class="form-text has-danger" v-show="errors.has('userTypeForm.userType')">{{ errors.first('userTypeForm.userType') }}</small>
            </div>

            <div class="form-group col">
                <button type="submit" class="btn btn-sm btn-success">Save</button>
                <button type="button" @click="closeModal('userTypeForm')" class="btn btn-sm btn-danger">
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
            user_type() {
                return this.$store.getters.getUserType;
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
                let user_type = {
                    id: this.user_type.id,
                    userType: this.user_type.userType
                };

                this.$validator.validateAll(scope).then((result) => {
                    if (result) { // if true submit form else set serverResponse error
                        if (this.formType == 'CREATE_USERTYPE') {
                            this.$store.dispatch('storeUserType', user_type).then(() => {
                                this.$store.dispatch('loadUserTypes', 'api/user_types');
                            });
                        } else if (this.formType == 'EDIT_USERTYPE') {
                            this.$store.dispatch('updateUserType', user_type)
                            .then(() => {
                                this.$store.dispatch('loadUserTypes', 'api/user_types');
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
