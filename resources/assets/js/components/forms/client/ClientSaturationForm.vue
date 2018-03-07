<template>
    <form id="saturationForm" @submit.prevent="submitForm('saturationForm')" data-vv-scope="saturationForm">
        <form-errors :serverResponse="serverResponse"></form-errors>
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="">Date of Saturation</label>
                <input v-model="saturation_date" type="date" v-validate="{rules:{required:true}}" name="saturation_date" id="" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('saturationForm.saturation_date')">{{ errors.first('saturationForm.saturation_date') }}</small>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Mode of Saturation</label>
                <select v-model="client_saturation.saturation_mode" v-validate="{rules:{required:true}}" name="saturation_mode" id="" class="form-control form-control-sm">
                    <option value="">--Select Mode of Saturation--</option>
                    <option v-for="(saturation, index) in saturations" :key="index" :value="saturation.id">{{ saturation.saturation_mode }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('saturationForm.saturation_mode')">{{ errors.first('saturationForm.saturation_mode') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Proposal made by</label>
                <select v-model="client_saturation.proposal_by" name="proposal_by" v-validate="{rules:{required:true}}" id="" class="form-control form-control-sm">
                    <option v-for="(user, index) in users" :key="index" :value="user.id"> {{ user.initial + ' ( ' +user.name+ ' ) ' }} </option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('saturationForm.proposal_by')">{{ errors.first('saturationForm.proposal_by') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Call Slip# (if personal)</label>
                <input v-model="client_saturation.call_slip" type="text" v-validate="{rules:{required:true}}" name="call_slip" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('saturationForm.call_slip')">{{ errors.first('saturationForm.call_slip') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Proposal Received & Accepted</label>
                <select v-model="client_saturation.proposal_accepted" name="proposal_accepted" v-validate="{rules:{required:true}}" id="" class="form-control form-control-sm">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('saturationForm.proposal_accepted')">{{ errors.first('saturationForm.proposal_accepted') }}</small>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Date Received</label>
                <input v-model="date_received" type="date" name="date_received" v-validate="{rules:{required:true}}" id="" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('saturationForm.date_received')">{{ errors.first('saturationForm.date_received') }}</small>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Manner of Confirmation</label>
                <select v-model="client_saturation.manner_of_confirmation" name="manner_of_confirmation" v-validate="{rules:{required:true}}" id="" class="form-control form-control-sm">
                    <option value="">--Select Confirmation--</option>
                    <option v-for="(confirmation, index) in confirmations" :key="index" :value="confirmation.id">{{ confirmation.confirmation_name }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('saturationForm.manner_of_confirmation')">{{ errors.first('saturationForm.manner_of_confirmation') }}</small>
            </div>
            
            <div class="form-group col-sm-12">
                <label for="">Made follow up calls? </label>
                <select @change="disableInput" v-model="client_saturation.ff_calls_made" name="ff_calls_made" id="" v-validate="{rules:{required:true}}" class="form-control form-control-sm">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('saturationForm.ff_calls_made')">{{ errors.first('saturationForm.ff_calls_made') }}</small>
            </div>
            
            <div class="form-group col-sm-12">
                <label for="">Date of Last Follow up Call</label>
                <input v-model="last_ffup_date" type="date" name="last_ffup_date" id="" class="form-control form-control-sm" :disabled="disable">
                <!-- <small class="form-text has-danger" v-show="errors.has('saturationForm.last_ffup_date')">{{ errors.first('saturationForm.last_ffup_date') }}</small> -->
            </div>
            
            <div class="form-group col-sm-12">
                <label for="">Company</label>
                <select v-model="client_saturation.company_id" name="company" v-validate="{rules:{required:true}}" id="" class="form-control form-control-sm">
                    <option v-for="(company, index) in companies" :key="index" :value="company.id"> {{ company.company_name + "(" + company.code + ")" }} </option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('saturationForm.company_id')">{{ errors.first('saturationForm.company_id') }}</small>
            </div>

            <div class="form-group col-md-12">
                <label for="">Client Response</label>
                <textarea v-model="client_saturation.client_response1" name="client_response1" id="" cols="30" v-validate="{rules:{required:true}}" rows="1" class="form-control form-control-sm"></textarea>
                <small class="form-text has-danger" v-show="errors.has('saturationForm.client_response1')">{{ errors.first('saturationForm.client_response1') }}</small>
            </div>
            
            <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-success btn-sm" :disabled="isSubmitting">
                    <span v-if="isSubmitting">
                        Saving...
                        <div class="loading"></div>
                    </span>
                    <span v-else>
                        Save Saturation Record
                    </span>
                </button>

                <button type="button" @click="closeModal('callForm')" class="btn btn-sm btn-danger">
                    Close
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import formErrors from '../../errors/clientForm/clientFormError';

    export default {
        mounted() {
            this.$store.dispatch('loadSaturations', 'api/maintenance/saturations?type=all');
            this.$store.dispatch('loadConfirmations', 'api/maintenance/confirmations?type=all');
        },
        data() {
            return {
                saturation_date: '',
                date_received: '',
                last_ffup_date: '',
                disable: false
            }
        },
        computed: {
            companies() {
                return this.$store.getters.getCompanies;  
            },
            isSubmitting() {
                return this.$store.getters.getSubmitState;
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
            query() {
                return this.$store.getters.getUserApiQuery;
            },
            columns() {
                return this.$store.getters.getColumns;
            },
            page_display() {
                return this.$store.getters.getPageDisplay;
            },
            client_id() {
                return this.$route.params.clientId;
            },
            client_saturation() {
                return this.$store.getters.getClientSaturation;
            },
            saturations() {
                return this.$store.getters.getSaturations;
            },
            confirmations() {
                return this.$store.getters.getConfirmations;
            },
            users() {
                return this.$store.getters.loadUsers;
            },
        },
        watch: {
            client_saturation: 'formatDate',
            //formType: 'clearDate'
        },
        methods: {
            submitForm(scope) {
                this.$validator.validateAll(scope).then((result) => {
                
                    if (result) { // if true submit form else set serverResponse error
                        let call_record = {
                            id: this.client_saturation.id,
                            client_id: this.$route.params.clientId,
                            company_id: this.client_saturation.company_id,
                            proposal_by: this.client_saturation.proposal_by,
                            call_slip: this.client_saturation.call_slip,
                            saturation_date: this.saturation_date,
                            saturation_mode: this.client_saturation.saturation_mode,
                            date_received: this.date_received,
                            proposal_accepted: this.client_saturation.proposal_accepted,
                            manner_of_confirmation: this.client_saturation.manner_of_confirmation,
                            ff_calls_made: this.client_saturation.ff_calls_made,
                            last_ffup_date: this.last_ffup_date,
                            client_response1: this.client_saturation.client_response1,
                        };

                        if (this.formType == 'NEW_CLIENT_SATURATION_RECORD') {
                                this.$store.dispatch('storeClientSaturation', call_record).then(() => {
                                    this.$store.dispatch('loadClientSaturations', `api/clients/${this.client_id}/saturations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                                });
                        } else if (this.formType == 'EDIT_CLIENT_SATURATION_RECORD') {
                                this.$store.dispatch('updateClientSaturation', call_record).then(() => {
                                    this.$store.dispatch('loadClientSaturations', `api/clients/${this.client_id}/saturations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                                });
                        } else {
                            toastr.error('Error', 'Unknown Command');
                        }
                    } else {

                    }
                });
            },
            closeModal(scope) {
                let payload = {
                    scope: scope,
                    errors: this.errors
                };
                this.$store.dispatch("setModalFormValidation", payload);
                this.$store.dispatch("closeModal", this.modalFormValidation);
            },
            formatDate() {
                if(this.formType == 'EDIT_CLIENT_SATURATION_RECORD'){
                    this.saturation_date = moment(this.client_saturation.saturation_date).format('YYYY-MM-DD');
                    this.date_received = moment(this.client_saturation.date_received).format('YYYY-MM-DD');
                    this.last_ffup_date = moment(this.client_saturation.last_ffup_date).format('YYYY-MM-DD');
                }
                else if(this.formType == 'NEW_CLIENT_SATURATION_RECORD'){    
                    // this.saturation_date = moment().format('YYYY-MM-DD');
                    // this.date_received = moment().format('YYYY-MM-DD');
                    // this.last_ffup_date = moment().format('YYYY-MM-DD');
                }
            },
            disableInput(){
                if(this.client_saturation.ff_calls_made == 0){
                    this.disable = true;
                }
                else{
                    this.disable = false;
                }
            }
        },
        components: {
            formErrors
        }
    };
</script>