<template>
    <div>
        <form id="contactPersonForm" @submit.prevent="submitForm('contactPersonForm')" data-vv-scope="contactPersonForm">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">First Name</label>
                    <input v-model="contact_person.first_name" data-vv-as="First name" v-validate="{rules:{required:true}}" name="contact_person_firstname" type="text" class="form-control form-control-sm" style="text-transform: uppercase">
                    <small class="form-text has-danger" v-show="errors.has('contactPersonForm.contact_person_firstname')">{{ errors.first('contactPersonForm.contact_person_firstname') }}</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Last Name</label>
                    <input v-model="contact_person.last_name" data-vv-as="Last name" v-validate="{rules:{required:true}}" name="contact_person_lastname" type="text" class="form-control form-control-sm" style="text-transform: uppercase">
                    <small class="form-text has-danger" v-show="errors.has('contactPersonForm.contact_person_lastname')">{{ errors.first('contactPersonForm.contact_person_lastname') }}</small>

                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Mobile no.</label>
                    <input v-model="contact_person.mobile_number" data-vv-as="Mobile no." v-validate="{rules:{required:true}}" name="mobile_number" type="text" class="form-control form-control-sm">
                    <small class="form-text has-danger" v-show="errors.has('contactPersonForm.mobile_number')">{{ errors.first('contactPersonForm.mobile_number') }}</small>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Email</label>
                    <input v-model="contact_person.email" data-vv-as="Email" v-validate="{rules:{required:true, email: true}}" name="email" type="email"
                        class="form-control form-control-sm">
                    <small class="form-text has-danger" v-show="errors.has('contactPersonForm.email')">{{ errors.first('contactPersonForm.email') }}</small>
                </div>
            </div>

            <!-- 6th row -->
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Department</label>
                    <select ref="department" v-model="contact_person.department" @change="reloadPositions" data-vv-as="Department" v-validate="{rules:{required:true}}" name="department" id=""
                        class="form-control form-control-sm">
                        <option value="">--Select Department--</option>option>
                        <option v-for="(department, index) in departments" :key="index" :value="department.id">
                            {{ department.department_name }}
                        </option>
                    </select>
                    <small class="form-text has-danger" v-show="errors.has('contactPersonForm.department')">{{ errors.first('contactPersonForm.department') }}</small>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Position</label>
                    <select ref="position" v-model="contact_person.position" v-validate="{rules:{required:true}}" data-vv-as="Position" name="position" id="" class="form-control form-control-sm">
                        <option value="">--Select Position--</option>
                        <option value="7">N/A</option>
                        <option v-for="(position, index) in positions" :key="index" :value="position.id">
                            {{ position.position_name }}
                        </option>

                    </select>
                    <small class="form-text has-danger" v-show="errors.has('contactPersonForm.position')">{{ errors.first('contactPersonForm.position') }}</small>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Gender</label>
                    <select v-model="contact_person.gender" v-validate="{rules:{required:true}}" name="gender" id="" class="form-control form-control-sm">
                        <option value="">--Select Gender--</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <small class="form-text has-danger" v-show="errors.has('contactPersonForm.gender')">{{ errors.first('contactPersonForm.gender') }}</small>
                </div>

                <div class="form-group col-12">
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                        <button type="button" @click="closeModal('contactPersonForm')" class="btn btn-sm btn-danger">
                        Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        created() {
            Echo.private('maintainance-channel')
                .listen('MaintainanceEvent', (e) => {
                    if (e.scope == "departments") {
                        this.$store.dispatch('loadDepartments', 'api/maintainance/departments?type=all');
                    }
                    if (e.scope == "positions") {
                        this.reloadPositions();
                    }
                });
        },
        data() {
            return {
                contact_person : {}
            }
        },
        computed: {
            departments() {
                return this.$store.getters.getDepartments;
            },
            positions() {
                return this.$store.getters.getPositions;
            },
            formType() {
                return this.$store.getters.getModalFormType;
            },
            modalFormValidation() {
                return this.$store.getters.getModalFormValidation;
            },
            contact_persons() {
                return this.$store.getters.getClientContactPersons;
            }
        },
        methods: {
            reloadPositions() {
                if (typeof this.contact_person.department != "undefined") {
                    this.$store.dispatch('loadPositions', 'api/maintainance/positions?type=all&department=' + this.contact_person
                        .department);
                }
            },
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
                        let contact_person = {
                            first_name: this.contact_person.first_name.toUpperCase(),
                            last_name: this.contact_person.last_name.toUpperCase(),
                            gender: this.contact_person.gender,
                            mobile_number: this.contact_person.mobile_number,
                            email: this.contact_person.email,
                            department: {
                               id: this.contact_person.department,
                               department_name: this.$refs.department.options[this.$refs.department.options.selectedIndex].text
                            },
                            position: {
                                id: this.contact_person.position,
                                position_name: this.$refs.position.options[this.$refs.position.options.selectedIndex].text
                            }
                        };

                        if (this.formType == 'CREATE_CONTACT_PERSON') {
                                this.$store.dispatch('storeContactPerson', contact_person);
                                this.contact_person = {}; //reset model
                                $('#createUserModal').modal('hide');

                        } else if (this.formType == 'EDIT_CONTACT_PERSON') {
                                
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