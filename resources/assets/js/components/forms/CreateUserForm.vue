<template>
    <div class="row">
        <div class="col-md-12">
            <form id="userForm" @submit.prevent="submitUserForm('userForm')" data-vv-scope="userForm">
                <div class="form-group">
                    <!-- <div class="alert alert-success" role="alert" v-if="serverResponse.status == 200">
                        {{ serverResponse.data }}
                    </div> -->
                    <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
        
                        <strong>Errors</strong> :{{ serverResponse.data.message }}
                        <ul v-if="serverResponse.data.errors.email">
                            <li v-for="e in serverResponse.data.errors.email" :key="e">{{ e }}</li>
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
                    <input data-vv-validate-on="'blur'" v-validate="{rules:{required:true, email:true}}" name="email" type="email" v-model="user.email" class="form-control">
                    <small class="form-text has-danger" v-show="errors.has('userForm.email')">{{ errors.first('userForm.email') }}</small>
                </div>
                <div class="form-group">
                    <label for="">User Type
                        <span class="required-field">*</span>
                    </label>
                    <select v-validate="{rules:{required:true}}" name="user_type" v-model="user.userType" id="" class="form-control">
                        <option></option>
                        <option v-for="user_type in user_types" :key="user_type.id" :value="user_type.id"> {{ user_type.userType }}</option>
                    </select>
                    <small class="form-text has-danger" v-show="errors.has('userForm.user_type')">{{ errors.first('userForm.user_type') }}</small>
                </div>
                <div class="form-group clearfix">
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
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

    },
    data() {
        return {

        }
    },
    computed: {
        user() {
            return this.$store.getters.loadUser;
        },
        user_types() {
            return this.$store.getters.loadUserTypes;
        },
        modalFormValidation() {
            return this.$store.getters.getModalFormValidation;
        },
        formType() {
            return this.$store.getters.getModalFormType;
        },
        serverResponse() {
            return this.$store.getters.getServerResponse;
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
                userType: this.user.userType
            };
            this.$validator.validateAll(scope).then((result) => {
                if (result) {
                    // console.log(result); //result returns true / false
                    // console.log(user);
                    if (this.formType == 'CreateUser') {
                        this.$store.dispatch('createUser', user);
                        this.$store.dispatch('loadUsers','/api/users');
                    }
                    else if (this.formType == 'EditUser') {
                        this.$store.dispatch('updateUser', user);
                        this.$store.dispatch('loadUsers','/api/users');
                    }
                    else {
                        alert('unknown action')
                    }
                }
                else {
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
