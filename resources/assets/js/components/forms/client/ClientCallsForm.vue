<template>
    <form id="callForm" @submit.prevent="submitForm('callForm')" data-vv-scope="callForm">
        <form-errors :serverResponse="serverResponse"></form-errors>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="caller">Caller</label>
                <select v-model="call.caller" v-validate="{rules:{required:true}}" name="caller" id="caller" class="form-control form-control-sm">]
                    <option value="">--Select Caller--</option>
                    <option v-for="(user, index) in users" :key="index" :value="user.id"> {{ user.initial + ' ( ' +user.name+ ' ) ' }} </option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('callForm.caller')">{{ errors.first('callForm.caller') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Company</label>
                <select v-model="call.company_id" name="company" v-validate="{rules:{required:true}}" id="" class="form-control form-control-sm">
                    <option v-for="(company, index) in companies" :key="index" :value="company.id"> {{ company.company_name + "(" + company.code + ")" }} </option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('callForm.company_id')">{{ errors.first('callForm.company_id') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Date of Call</label>
                <input v-model="date_of_call" v-validate="{rules:{required:true}}" type="date" id="date_of_call" name="date_of_call" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('callForm.date_of_call')">{{ errors.first('callForm.date_of_call') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Confirmation Pre-Call</label>
                <select v-model="call.confirmation_preCall" v-validate="{rules:{required:true}}" name="confirmation_precall" id="" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('callForm.confirmation_precall')">{{ errors.first('callForm.confirmation_precall') }}</small>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Productive Call</label>
                <select v-model="call.productive_call" v-validate="{rules:{required:true}}" name="productive_call" id="" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('callForm.productive_call')">{{ errors.first('callForm.productive_call') }}</small>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Proposal was send?</label>
                <select v-model="call.proposal_sent" v-validate="{rules:{required:true}}" name="proposal" id="" class="form-control form-control-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('callForm.proposal')">{{ errors.first('callForm.proposal') }}</small>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Client Reponse</label>
                <textarea v-model="call.client_response" v-validate="{rules:{required:true}}" name="client_response" class="form-control form-control-sm" id="" cols="30" rows="1"></textarea>
                <small class="form-text has-danger" v-show="errors.has('callForm.client_response')">{{ errors.first('callForm.client_response') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-success btn-sm" :disabled="isSubmitting">
                    <span v-if="isSubmitting">
                        Saving...
                        <div class="loading"></div>
                    </span>
                    <span v-else>
                        Save Call Record
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
        beforeCreate() {
            
        },
        created() {

        },
        data() {
            return {
                date_of_call:''
            }
        },
        computed: {
            isSubmitting() {
                return this.$store.getters.getSubmitState;
            },
            modalFormValidation() {
                return this.$store.getters.getModalFormValidation;
            },
            formType() {
                return this.$store.getters.getModalFormType;
            },
            users() {
                return this.$store.getters.loadUsers;
            },
            companies() {
                return this.$store.getters.getCompanies;  
            },
            serverResponse() {
                return this.$store.getters.getServerResponse;
            },
            call() {
                return this.$store.getters.getClientCall;
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
        },
        watch: {
            call: 'formatDate',
            //formType: 'clearDate'
        },
        methods: {
            submitForm(scope) {
                
                this.$validator.validateAll(scope).then((result) => {
                
                    if (result) { // if true submit form else set serverResponse error
                        let call_record = {
                            id: this.call.id,
                            client_id: this.$route.params.clientId,
                            company_id: this.call.company_id,
                            caller: this.call.caller,
                            date_of_call: this.date_of_call,
                            confirmation_preCall: this.call.confirmation_preCall,
                            productive_call: this.call.productive_call,
                            proposal_sent: this.call.proposal_sent,
                            client_response: this.call.client_response,
                        };

                        if (this.formType == 'NEW_CALL_RECORD') {
                                this.$store.dispatch('storeClientCall', call_record).then(() => {
                                    this.$store.dispatch('loadClientCalls', `api/clients/${this.client_id}/calls?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                                });
                        } else if (this.formType == 'EDIT_CALL_RECORD') {
                                this.$store.dispatch('updateClientCall', call_record).then(() => {
                                    this.$store.dispatch('loadClientCalls', `api/clients/${this.client_id}/calls?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
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
                if(this.formType == 'EDIT_CALL_RECORD'){    
                    this.date_of_call = moment(this.call.date_of_call).format('YYYY-MM-DD');
                }
            },
        },
        components: {
            formErrors,
        }
    };
</script>