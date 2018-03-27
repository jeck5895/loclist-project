<template>
    <div class="row">
        <div class="col-md-12">
            <form id="userForm" @submit.prevent="submitUserForm('userForm')" data-vv-scope="userForm">
                <div class="form-group">
                    <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                        <strong>Errors</strong> :{{ serverResponse.data.message }}
                        <ul v-if="serverResponse.data.errors">
                            <template v-if="serverResponse.data.errors.email">
                                <li v-for="e in serverResponse.data.errors.email" :key="e">{{ e }}</li>
                            </template>
                        </ul>
                    </div>

                    <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                        <strong>You are not authorized to perform this action</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">
                        Name
                        <span class="required-field">*</span>
                    </label>
                    <input v-validate="{rules:{required:true}}" name="name" type="text" v-model="user.name" class="form-control">
                    <small class="form-text has-danger" v-show="errors.has('userForm.name')">{{ errors.first('userForm.name') }}</small>
                </div>
                <div class="form-group">
                    <label for="">Initial
                        <span class="required-field">*</span>
                    </label>
                    <input v-validate="{rules:{required:true}}" name="initial" type="text" v-model="user.initial" class="form-control">
                    <small class="form-text has-danger" v-show="errors.has('userForm.initial')">{{ errors.first('userForm.initial') }}</small>
                </div>
                <div class="form-group">
                    <label for="">Email
                        <span class="required-field">*</span>
                    </label>
                    <input data-vv-validate-on="'blur'" v-validate="{rules:{required:true, email:true}}" name="email" type="email" v-model="user.email"
                        class="form-control">
                    <small class="form-text has-danger" v-show="errors.has('userForm.email')">{{ errors.first('userForm.email') }}</small>
                </div>
                <div class="form-group">
                    <label for="">User Type
                        <span class="required-field">*</span>
                    </label>
                    <select v-validate="{rules:{required:true}}" name="user_type" v-model="user.userType" id="" class="form-control">
                        <option>--Select User Type--</option>
                        <option v-if="user_types" v-for="user_type in user_types" :key="user_type.id" :value="user_type.id"> {{ user_type.userType }}</option>
                    </select>
                    <small class="form-text has-danger" v-show="errors.has('userForm.user_type')">{{ errors.first('userForm.user_type') }}</small>
                </div>
                <div class="form-group">
                    <label for="">User Division
                        <span class="required-field">*</span>
                    </label>
                    <select v-validate="{rules:{required:true}}" name="user_division" v-model="user.division" id="" class="form-control">
                        <option>--Select User Division--</option>
                        <option v-for="(division, index) in divisions" :key="index" :value="division.id"> {{ division.name }}</option>
                    </select>
                    <small class="form-text has-danger" v-show="errors.has('userForm.user_division')">{{ errors.first('userForm.user_division') }}</small>
                </div>
                <div class="form-group clearfix">
                    <button type="submit" class="btn btn-success btn-sm" :disabled="isSubmitting">
                            <span v-if="isSubmitting" >
                                Saving...  <div class="loading"></div>
                            </span>
                            <span v-else>
                                Save User
                            </span>
                        </button>
                    <button type="button" @click="closeModal('userForm')" class="btn btn-sm btn-danger">
                        Close
                    </button>

                </div>
            </form>
        </div>
    </div>
</template>

<script>
    /**@constant
     *  Perform an ajax validation to the server     
     * const isUniqueEmail = (value) => {
     *  return axios.post('/api/')
    }; */
    // import { Validator } from 'vee-validate';

    // const uniqueEmail = 

    export default {
        mounted() {
            this.$store.dispatch('loadUserTypes', 'api/maintenance/user_types?type=all');
        },
        data() {
            return {
                divisions: [
                    { id: 1, name: 'North Luzon / GMA' },
                    { id: 2, name: 'South Luzon' },
                    { id: 3, name: 'N/A'  }
                ],
            }
        },
        computed: {
            user() {
                return this.$store.getters.loadUser;
            },
            user_types() {
                return this.$store.getters.getUserTypes;
            },
            modalFormValidation() {
                return this.$store.getters.getModalFormValidation;
            },
            formType() {
                return this.$store.getters.getModalFormType;
            },
            serverResponse() {
                return this.$store.getters.getServerResponse;
            },
            user_query() {
                return this.$store.getters.getUserApiQuery;
            },
            columns() {
                return this.$store.getters.getColumns;
            },
            page_display() {
                return this.$store.getters.getPageDisplay;
            },
            isSubmitting() {
                return this.$store.getters.getSubmitState;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            }
        },
        methods: {
            closeModal(scope) {
                //console.log(scope);
                //this.errors.clear(scope);
                let payload = {
                    scope: scope,
                    errors: this.errors
                };
                this.$store.dispatch('setModalFormValidation', payload);
                this.$store.dispatch('closeModal', this.modalFormValidation);
            },
            submitUserForm(scope) {
                let user = {
                    id: this.user.id,
                    uid: this.user.uid,
                    name: this.user.name,
                    initial: this.user.initial,
                    email: this.user.email,
                    userType: this.user.userType,
                    division: this.user.division
                };
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        // console.log(result); //result returns true / false
                        // console.log(user);
                        if (this.formType == 'CREATE_USER') {
                            this.$store.dispatch('storeUser', user).then(() => {
                                this.$store.dispatch('loadUsers',
                                `api/users?keyword=${this.user_query.search_keyword}&order_by=${this.user_query.order_by}&per_page=${this.user_query.per_page}&sort_column=${this.user_query.sort_column}`
                                );
                            })
                            .catch(error=> {

                            });
                            
                        } else if (this.formType == 'EDIT_USER') {
                            this.$store.dispatch('updateUser', user).then(response => {

                            })
                            .catch(error => {
                                this.$store.dispatch('loadUsers',
                                    `api/users?keyword=${this.user_query.search_keyword}&order_by=${this.user_query.order_by}&per_page=${this.user_query.per_page}&sort_column=${this.user_query.sort_column}`
                                );
                            });
                            
                        } else {
                            alert('unknown action')
                        }
                    } else {
                        console.log(result)
                        let payload = {
                            scope: scope,
                            errors: this.errors
                        };
                        this.$store.dispatch('setModalFormValidation', payload);
                    }
                });
            }
        }
    }
</script>