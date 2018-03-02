<template>
    <form id="presentationForm" @submit.prevent="submitForm('presentationForm')" data-vv-scope="presentationForm">
        <form-errors :serverResponse="serverResponse"></form-errors>
        <div class="row">
            <div class="form-group form-group-sm col-sm-12">
                <label for="">Mode of Presentation</label>
                <select v-model="client_presentation.presentation_mode" v-validate="{rules:{required:true}}" name="presentation_mode" id=""
                    class="form-control form-control-sm">
                    <option value="">--Select mode of presentation--</option>
                    <option v-for="(presentation, index) in mode_of_presentations " :key="index" :value="presentation.id"> {{ presentation.presentation_mode }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('presentationForm.caller')">{{ errors.first('presentationForm.caller') }}</small>
            </div>
            <div class="form-group form-group-sm col-sm-12">
                <label for="">Presentor</label>
                <select v-model="client_presentation.presentor" v-validate="{rules:{required:true}}" name="caller" id="caller" class="form-control form-control-sm">]
                    <option value="">--Select user--</option>
                    <option v-for="(user, index) in users" :key="index" :value="user.id"> {{ user.initial + ' ( ' +user.name+ ' ) ' }} </option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('presentationForm.presentor')">{{ errors.first('presentationForm.presentor') }}</small>
            </div>

            <div class="form-group form-group-sm col-sm-12">
                <label for="">Date of Presentation</label>
                <input v-model="date_presented" v-validate="{rules:{required:true}}" type="date" name="date_presented" id="" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('presentationForm.date_presented')">{{ errors.first('presentationForm.date_presented') }}</small>
            </div>

            <div class="form-group form-group-sm col-sm-12">
                <label for="">Status per Presentation</label>
                <select v-model="client_presentation.presentation_status" v-validate="{rules:{required:true}}" name="presentation_status"
                    id="" class="form-control form-control-sm">
                    <option value="">--Select status--</option>
                    <option v-for="(presentation_status, index) in presentation_statuses " :key="index" :value="presentation_status.id"> {{ presentation_status.status }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('presentationForm.presentation_status')">{{ errors.first('presentationForm.presentation_status') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <label for="">Company</label>
                <select v-model="client_presentation.company_id" name="company" v-validate="{rules:{required:true}}" id="" class="form-control form-control-sm">
                    <option v-for="(company, index) in companies" :key="index" :value="company.id"> {{ company.company_name + " (" + company.code + ")" }} </option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('presentationForm.company')">{{ errors.first('presentationForm.company') }}</small>
            </div>

            <div class="form-group form-group-sm col-sm-12">
                <label for="">Date of follow-up meeting</label>
                <input v-model="follow_up_meeting_date" v-validate="{rules:{required:false}}" type="date" name="follow_up_meeting_date"
                    id="" class="form-control form-control-sm">
                <small class="form-text has-danger" v-show="errors.has('presentationForm.follow_up_meeting_date')">{{ errors.first('presentationForm.follow_up_meeting_date') }}</small>
            </div>
            <div class="form-group form-group-sm col-sm-12">
                <label for="">Action Plan</label>
                <select v-model="client_presentation.action_plan" v-validate="{rules:{required:true}}" name="action_plan" id="" class="form-control form-control-sm">
                    <option value="">--Select Action Plan--</option>
                    <option v-for="(action_plan, index) in action_plans " :key="index" :value="action_plan.id"> {{ action_plan.action_name }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('presentationForm.action_plan')">{{ errors.first('presentationForm.action_plan') }}</small>
            </div>

            <div class="form-group form-group-sm col-sm-12">
                <label for="">Client Response</label>
                <textarea v-model="client_presentation.client_response2" v-validate="{rules:{required:true}}" name="client_response2" id=""
                    cols="30" rows="5" class="form-control form-control-sm"></textarea>
                <small class="form-text has-danger" v-show="errors.has('presentationForm.client_response2')">{{ errors.first('presentationForm.client_response2') }}</small>
            </div>

            <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-success btn-sm" :disabled="isSubmitting">
                    <span v-if="isSubmitting">
                        Saving...
                        <div class="loading"></div>
                    </span>
                    <span v-else>
                        Save Presentation Record
                    </span>
                </button>

                <button type="button" @click="closeModal('presentationForm')" class="btn btn-sm btn-danger">
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
                date_presented: '',
                follow_up_meeting_date: ''
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
            action_plans() {
                return this.$store.getters.getActionPlans;
            },
            presentation_statuses() {
                return this.$store.getters.getPresentationStatuses;
            },
            mode_of_presentations() {
                return this.$store.getters.getModeOfPresentations;
            },
            serverResponse() {
                return this.$store.getters.getServerResponse;
            },
            client_presentation() {
                return this.$store.getters.getClientPresentation;
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
            client_presentation: 'formatDate',
            //formType: 'clearDate'
        },
        methods: {
            submitForm(scope) {

                this.$validator.validateAll(scope).then((result) => {

                    if (result) { // if true submit form else set serverResponse error
                        let presentation_record = {
                            id: this.client_presentation.id,
                            client_id: this.$route.params.clientId,
                            company_id: this.client_presentation.company_id,
                            presentation_mode: this.client_presentation.presentation_mode,
                            presentor: this.client_presentation.presentor,
                            date_presented: this.date_presented,
                            call_slip2: this.client_presentation.call_slip2,
                            client_response2: this.client_presentation.client_response2,
                            presentation_status: this.client_presentation.presentation_status,
                            follow_up_meeting_date: this.follow_up_meeting_date,
                            action_plan: this.client_presentation.action_plan
                        };

                        if (this.formType == 'NEW_PRESENTATION_RECORD') {
                            this.$store.dispatch('storeClientPresentation', presentation_record).then(() => {
                                this.$store.dispatch('loadClientPresentations',
                                    `api/clients/${this.client_id}/presentations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`
                                );
                            });
                        } else if (this.formType == 'EDIT_PRESENTATION_RECORD') {
                            this.$store.dispatch('updateClientPresentation', presentation_record).then(() => {
                                this.$store.dispatch('loadClientPresentations',
                                    `api/clients/${this.client_id}/presentations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`
                                );
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
                if (this.formType == 'EDIT_PRESENTATION_RECORD') {
                    this.date_presented = moment(this.client_presentation.date_presented).format('YYYY-MM-DD');
                    this.follow_up_meeting_date = moment(this.client_presentation.follow_up_meeting_date).format(
                        'YYYY-MM-DD');
                } else if (this.formType == 'NEW_PRESENTATION_RECORD') {
                    //this.date_presented = moment().format('YYYY-MM-DD');
                    //this.follow_up_meeting_date = moment().format('YYYY-MM-DD');
                }
            },
        },
        components: {
            formErrors,
        }
    }
</script>

<style>

</style>