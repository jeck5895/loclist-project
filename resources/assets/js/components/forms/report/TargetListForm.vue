<template>
    <form id="targetListForm" @submit.prevent="submitForm('targetListForm')" data-vv-scope="targetListForm">
        <form-errors :serverResponse="serverResponse"></form-errors>
        <div class="row clearfix">
            <div class="form-group col-sm-6 float-left">
                <label for="exampleDropdownFormEmail1" class="mr-1">Month</label>
                <select v-model="target_month" v-validate="{rules:{required:true}}" name="target_month" id="" class="form-control form-control-sm mr-3">
                    <option v-for="(month, index) in report_months" :key="index" :value="month.id">{{ month.name }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('targetListForm.target_month')">{{ errors.first('targetListForm.target_month') }}</small>
            </div>
            <div class="form-group col-sm-6 float-right">
                <label for="exampleDropdownFormEmail1" class="mr-1">Year</label>
                <select v-model="target_year" v-validate="{rules:{required:true}}" name="target_year" id="" class="form-control form-control-sm">
                    <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                </select>
                <small class="form-text has-danger" v-show="errors.has('targetListForm.target_year')">{{ errors.first('targetListForm.target_year') }}</small>
            </div>
        </div>
        <div class="form-group">
            <label for="">Target increase of potential client</label>
            <input v-model="target_list.target_increase_potential_client" v-validate="{rules:{required:true}}" name="potential_client" type="number" class="form-control form-control-sm">
            <small class="form-text has-danger" v-show="errors.has('targetListForm.potential_client')">{{ errors.first('targetListForm.potential_client') }}</small>
        </div>
        <div class="form-group">
            <label for="">Target number of calls made</label>
            <input v-model="target_list.target_no_of_calls_made" v-validate="{rules:{required:true}}" name="calls_made" type="number" class="form-control form-control-sm">
            <small class="form-text has-danger" v-show="errors.has('targetListForm.calls_made')">{{ errors.first('targetListForm.calls_made') }}</small>
        </div>
        <div class="form-group">
            <label for="">Target proposal to be sent</label>
            <input v-model="target_list.target_proposal_tobe_sent" v-validate="{rules:{required:true}}" name="proposal_sent" type="number" class="form-control form-control-sm">
            <small class="form-text has-danger" v-show="errors.has('targetListForm.proposal_sent')">{{ errors.first('targetListForm.proposal_sent') }}</small>
        </div>

        <div class="form-group">
            <label for="">Target no. of formal presentation</label>
            <input v-model="target_list.target_no_formal_presentation" v-validate="{rules:{required:true}}" name="formal_presentation" type="number" class="form-control form-control-sm">
            <small class="form-text has-danger" v-show="errors.has('targetListForm.formal_presentation')">{{ errors.first('targetListForm.formal_presentation') }}</small>
        </div>
        <div class="form-group">
            <label for="">Target client to be acquired</label>
            <input v-model="target_list.target_client_tobe_acquired" v-validate="{rules:{required:true}}" name="client_tobe_acquired" type="number" class="form-control form-control-sm">
            <small class="form-text has-danger" v-show="errors.has('targetListForm.client_tobe_acquired')">{{ errors.first('targetListForm.client_tobe_acquired') }}</small>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm" :disabled="isSubmitting">
                <span v-if="isSubmitting">
                    Saving...
                    <div class="loading"></div>
                </span>
                <span v-else>
                    Save target list
                </span>
            </button>
        </div>
    </form>
</template>

<script>
    import formErrors from '../../errors/clientForm/clientFormError';

    export default {
        created() {
            this.checkLocal();
        },
        data() {
            return {
                target_month: null,
                target_year: null,
            }
        },
        computed: {
            target_list() {
                return this.$store.getters.getTargetList;
            },
            isSubmitting() {
                return this.$store.getters.getSubmitState;
            },
            formType() {
                return this.$store.getters.getModalFormType;
            },
            modalFormValidation() {
                return this.$store.getters.getModalFormValidation;
            },
            serverResponse() {
                return this.$store.getters.getServerResponse;
            },
            report_months() {
                return this.$store.getters.getReportMonths;
            },
            years: function () {
                let years = [];

                for (let current_year = new Date().getFullYear(); current_year >= 2000; current_year--) {
                    years.push(current_year);
                }

                return years;
            }
        },
        watch: {
            target_list: 'setTargetData',
        },
        methods: {
            setTargetData() {
                if(this.target_list.month_id){
                    this.target_month = this.target_list.month_id;
                }
                if(this.target_list.target_year){
                    this.target_year = this.target_list.target_year;
                }
            },
            checkLocal () {
                this.target_month = localStorage.getItem('_tMnth'),
                this.target_year = localStorage.getItem('_tYr')
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
                        let target_list = {
                            id: this.target_list.id,
                            month_id: this.target_month,
                            target_increase_potential_client: this.target_list.target_increase_potential_client,
                            target_no_of_calls_made: this.target_list.target_no_of_calls_made,
                            target_proposal_tobe_sent: this.target_list.target_proposal_tobe_sent,
                            target_no_formal_presentation: this.target_list.target_no_formal_presentation,
                            target_client_tobe_acquired: this.target_list.target_client_tobe_acquired,
                            target_year: this.target_year
                        };
                        
                        if (this.formType == 'CREATE_TARGET_LIST') {
                            this.$store.dispatch('storeTargetList', target_list).then(() => {
                                this.$store.dispatch('loadTargetLists', 'api/reports/target-lists');
                                this.$store.dispatch('clearTargetList');

                                if(parseInt(this.target_month) + 1 > 12) {
                                    $("#createUserModal").modal('hide');
                                }

                                let next_month = this.target_month < 12 ? parseInt(this.target_month) + 1 : 1;
                                let next_year =  this.target_year; 
                                this.target_month = next_month;
                                localStorage.setItem('_tMnth', next_month);
                                localStorage.setItem('_tYr', next_year);
                                $("input[name=potential_client]").focus();
                            });
                            // console.log(target_list)
                        } else if (this.formType == 'EDIT_TARGET_LIST') {
                            this.$store.dispatch('updateTargetList', target_list)
                            .then(() => {
                                this.$store.dispatch('loadTargetLists', 'api/reports/target-lists');
                            });
                        } else {
                            toastr.error('Error', 'Unknown Command');
                        }
                    } else {
                        
                    }
                });
            }
        },
        components: {
            formErrors,
        },
    }
</script>

<style>
</style>