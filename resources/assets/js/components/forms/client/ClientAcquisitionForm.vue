<template>
    <form id="acquisitionForm" @submit.prevent="submitForm('acquisitionForm')" data-vv-scope="acquisitionForm">
        <form-errors :serverResponse="serverResponse"></form-errors>
        <div class="row">
            <!-- <div class="form-group col-sm-12">
                <label for="">Status as of</label>
                <input v-model="status_as_of" v-validate="{rules:{required:true}}" type="date" name="status_as_of" id="" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.status_as_of')">{{ errors.first('acquisitionForm.status_as_of') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Status</label>
                <select v-model="client_acquisition.status" v-validate="{rules:{required:true}}" name="status_as_of" id="" class="form-control form-control-sm">
                    <option v-for="(status, index) in statuses" :key="index" :value="status.id">{{ status.status }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.status')">{{ errors.first('acquisitionForm.status') }}</small>
            </div> -->

            <div class="form-group col-sm-12">
                <label for="">Date Acquired </label>
                <input v-model="date_acquired" type="date" v-validate="'required'" data-vv-as="Date Acquired" name="date_acquired" id="" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.date_acquired')">{{ errors.first('acquisitionForm.date_acquired') }}</small>
            </div>
            
            <div class="form-group col-sm-12">
                <label for="">Acquired By </label>
                <select v-model="client_acquisition.acquired_by" v-validate="'required'" data-vv-as="Acquired by" name="acquired_by" id="acquired_by" class="form-control form-control-sm">]
                    <option value="">--Select User--</option>
                    <option v-for="(user, index) in users" :key="index" :value="user.id"> {{ user.initial + ' ( ' +user.name+ ' ) ' }} </option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.acquired_by')">{{ errors.first('acquisitionForm.acquired_by') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Signed Contract</label>
                <select v-model="client_acquisition.signed_contract" v-validate="'required'" data-vv-as="Signed Contract" name="signed_contract" id="" class="form-control form-control-sm">
                    <option value="N/A">N/A</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.signed_contract')">{{ errors.first('acquisitionForm.signed_contract') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Manner of Acquisition</label>
                <select v-model="client_acquisition.manner_of_acquisition" v-validate="'required'" data-vv-as="Manner of Acquisition" name="manner_of_acquisition" id="" class="form-control form-control-sm">
                    <option v-for="(acquisition, index) in manner_of_acquisitions" :key="index" :value="acquisition.id">{{ acquisition.acquisition_name }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.manner_of_acquisition')">{{ errors.first('acquisitionForm.manner_of_acquisition') }}</small>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Initial Head Count Required</label>
                <input v-model="client_acquisition.initial_hc_acquired" type="number" v-validate="'required'" data-vv-as="Initial Head Count" name="initial_hc_acquired" class="form-control form-control-sm" id="">
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.initial_hc_acquired')">{{ errors.first('acquisitionForm.initial_hc_acquired') }}</small>
            </div>
            <div class="form-group col-sm-12">
                <label for="">If not owned, who referred? Or name of related client</label>
                <input v-model="client_acquisition.name_of_related_client" name="related_client" v-validate="'required'" data-vv-as="Referral" type="text" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.related_client')">{{ errors.first('acquisitionForm.related_client') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Company</label>
                <select v-model="client_acquisition.company_id" name="company" v-validate="{rules:{required:true}}" id="" class="form-control form-control-sm">
                    <option v-for="(company, index) in companies" :key="index" :value="company.id"> {{ company.company_name + " (" + company.code + ")" }} </option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.company')">{{ errors.first('acquisitionForm.company') }}</small>
            </div>


            <div class="form-group col-sm-12">
                <label for="">Remarks</label>
                <textarea v-model="client_acquisition.remarks" v-validate="{rules:{required:true}}" name="remarks" id="" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                <small class="form-text has-danger" v-show="errors.has('acquisitionForm.remarks')">{{ errors.first('acquisitionForm.remarks') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-success btn-sm" :disabled="isSubmitting">
                    <span v-if="isSubmitting">
                        Saving...
                        <div class="loading"></div>
                    </span>
                    <span v-else>
                        Save Acquisition Record
                    </span>
                </button>

                <button type="button" @click="closeModal('acquisitionForm')" class="btn btn-sm btn-danger">
                    Close
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import formErrors from '../../errors/clientForm/clientFormError';

    export default {
        data() {
            return {
                date_acquired: '',
                // status_as_of: ''
            }
        },
        computed: {
            client() {
                return this.$store.getters.getClient;
            },
            client_acquisition() {
                return this.$store.getters.getClientAcquisition;
            },
            isSubmitting() {
                return this.$store.getters.getSubmitState;
            },
            statuses() {
                return this.$store.getters.getStatuses;
            },
            users() {
                return this.$store.getters.loadUsers;
            },
            companies() {
                return this.$store.getters.getCompanies;
            },
            manner_of_acquisitions() {
                return this.$store.getters.getAcquisitions;
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
        },
        watch: {
            client_acquisition: 'formatDate',
        },
        methods: {
            submitForm(scope) {
                this.$validator.validateAll(scope).then((result) => {
                
                    if (result) { // if true submit form else set serverResponse error
                        let acquisition_record = {
                            id: this.client_acquisition.id,
                            client_id: this.$route.params.clientId,
                            company_id: this.client_acquisition.company_id,
                            // status_as_of: this.status_as_of,
                            // status: this.client_acquisition.status,
                            acquired_by: this.client_acquisition.acquired_by,
                            date_acquired: this.date_acquired,
                            name_of_related_client: this.client_acquisition.name_of_related_client,
                            signed_contract: this.client_acquisition.signed_contract,
                            manner_of_acquisition: this.client_acquisition.manner_of_acquisition,
                            initial_hc_acquired: this.client_acquisition.initial_hc_acquired,
                            remarks: this.client_acquisition.remarks
                        };

                        if (this.formType == 'NEW_CLIENT_ACQUISITION_RECORD') {
                                this.$store.dispatch('storeClientAcquisition', acquisition_record).then(() => {
                                    // this.client.negotiation_status = 6; //set client status to acquired
                                    // this.client.task_status = 13;
                                    // this.$store.dispatch('updateClient', this.client);
                                    this.$store.dispatch('loadClientAcquisitions', `api/clients/${this.client_id}/acquisitions?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                                });
                        } else if (this.formType == 'EDIT_CLIENT_ACQUISITION_RECORD') {
                                this.$store.dispatch('updateClientAcquisition', acquisition_record).then(() => {
                                    this.$store.dispatch('loadClientAcquisitions', `api/clients/${this.client_id}/acquisitions?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
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
                if (this.formType == 'EDIT_CLIENT_ACQUISITION_RECORD') {
                    if(this.client_acquisition.date_acquired != null){
                        this.date_acquired = moment(this.client_acquisition.date_acquired).format('YYYY-MM-DD');
                    }
                    //this.status_as_of = moment(this.client_acquisition.status_as_of).format('YYYY-MM-DD');
                } else if (this.formType == 'NEW_CLIENT_ACQUISITION_RECORD') {
                    // this.date_acquired = moment().format('YYYY-MM-DD');
                    // this.status_as_of = moment().format('YYYY-MM-DD');
                }
            },
        },
        components: {
            formErrors,
        }
    };
</script>

<style>

</style>