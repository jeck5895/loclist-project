<template>
    <div class="row justify-content-center">
        <div class="col-md-9">

            <nav-buttons></nav-buttons>

            <div class="card">
                <div class="card-header clearfix bg-white">
                    <h4 class="float-left">Company Information</h4>
                    <div v-if="!isLoading" class="row float-right">
                        <dt style="width: 10%;"> <span class="fa fa-user"></span></dt>  <dd class="mb-0" style="width: 90%;"> {{ client.user.name }} </dd>
                        <dt style="width: 10%;"> <span class="fa fa-calendar"></span></dt>  <dd class="mb-0" style="width: 90%;"> {{ client.created_at | humanReadableFormat }} </dd>
                        
                    </div>
                </div>
                <div v-if="isLoading" class="card-body">
                    <div class="row">
                        <div class="img-loading-container">
                            <img src="/images/spinner.gif" class="img-sm">
                        </div>   
                    </div>
                </div>
                <div v-else class="card-body">
                    
                    <img src="/images/img-default.png" alt="" width="150" height="150" class="client-profile img-thumbnail">
                   
                    <dl class="row">
                        <dt class="col-sm-3">
                            Client Name
                        </dt>
                        <dd class="col-sm-9">
                            <span class="lead">{{ client.client_name }}</span>
                        </dd>
                        <dt class="col-sm-3">
                            Industry
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.company_industry.industry_name }}
                        </dd>
                        <dt class="col-sm-3">
                            Nationality
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.company_nationality.nationality}}
                        </dd>
                        <dt class="col-sm-3">
                            ISO Certification
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.company_certificate.iso_name }}
                        </dd>
                        <dt class="col-sm-3">
                            Mailing Address
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.complete_mailing_address }}
                        </dd>
                        <dt class="col-sm-3">
                            Techno Park
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.techno_park }}
                        </dd>
                        <dt class="col-sm-3">
                            Address
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.street_address + " " + client.province }}
                        </dd>
                        <dt class="col-sm-3">
                            Area
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.administrative_area_level_1 }}
                        </dd>
                        <dt class="col-sm-3">
                            Zip Code
                        </dt>
                        <dd class="col-sm-9">
                           {{ client.postal_code }}
                        </dd>
                        <dt class="col-sm-3">
                            Official Website
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.website != 'N/A' ? website : 'N/A' }}
                            <a v-if="client.website != 'N/A'" :href="website" style="color:black;" :target="client.website"><span class="fa fa-external-link-square"></span></a>
                        </dd>

                        <dt class="col-sm-3">
                            Primary Landline
                        </dt>
                        <dd class="col-sm-9">
                           {{ client.primary_landline }}
                        </dd>

                        <dt class="col-sm-3">
                            Other Landline
                        </dt>
                        <dd class="col-sm-9">
                            {{ client.other_landline }}
                        </dd>
                    </dl>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h5 >Contact Person(s)</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div v-for="(contact_person, index) in client.contact_persons" :key="index" class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Contact Person</dt>
                                <dd class="col-sm-8">{{ contact_person.first_name + " " + contact_person.last_name}}</dd>

                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8">{{ contact_person.email }}</dd>

                                <dt class="col-sm-4">Mobile No.</dt>
                                <dd class="col-sm-8">{{ contact_person.mobile_number }}</dd>

                                <dt class="col-sm-4">Gender</dt>
                                <dd class="col-sm-8">{{ contact_person.gender }}</dd>

                                <dt class="col-sm-4">Deparment</dt>
                                <dd class="col-sm-8">{{ contact_person.department.department_name }}</dd>

                                <dt class="col-sm-4">Position</dt>
                                <dd v-if="contact_person.position.position_name" class="col-sm-8">{{ contact_person.position.position_name }}</dd>
                                <dd v-else class="col-sm-8"><i class="text-muted">(Position have been removed)</i></dd>
                            </dl>
                        </div>
                    </div>
                    <hr>
                    <dl class="row">
                        <dt class="col-sm-3">Manpower</dt>
                        <dd class="col-sm-9">{{ client.company_manpower_type.type }}</dd>

                        <dt class="col-sm-3">Sourcing Practices</dt>
                        <dd class="col-sm-9">
                            <span v-if="client.sourcing_practices.length == 0">
                                <em>No sourcing practices provided...</em>
                            </span>
                            <span v-else v-for="(sp, index) in client.sourcing_practices" :key="index"> 
                                {{ (client.sourcing_practices.length-1 != index) ? sp.name + ', ' : sp.name }} 
                            </span>
                        </dd>

                        <dt class="col-sm-3">Manpower Provider</dt>
                        <dd class="col-sm-9">
                            <span v-if="client.manpower_providers.length == 0">
                                <em>No manpower providers provided...</em>
                            </span>
                            <span v-else v-for="(provider, index) in client.manpower_providers" :key="index"> 
                                {{ (client.manpower_providers.length-1 != index) ? provider.manpower_provider + ', ' : provider.manpower_provider }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Proposal</dt>
                        <dd class="col-sm-9">{{ client.proposal }}</dd>

                        <dt class="col-sm-3">Company</dt>
                        <dd class="col-sm-9">{{ client.provider_company.company_name }}</dd>
                    </dl>
                </div>
                <div class="card-footer bg-white">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#calls" role="tab"><strong>Calls</strong></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#saturation" role="tab"><strong>Saturation</strong></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#presentation" role="tab"><strong>Presentation</strong></a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#acquisition" role="tab"><strong>Acquisition</strong></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="calls" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mb-2 mt-2">
                                <button class="btn btn-sm btn-default" @click="showModalForm(clientId, 'NEW_CALL_RECORD')">
                                  <span class="fa fa-phone-square"></span>  New Call Record
                                </button>
                            </div>
                            <client-calls-table :clientId="clientId" :displayOptions="true"></client-calls-table>
                        </div>

                        <div class="tab-pane fade" id="saturation" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mb-2 mt-2">
                                <button class="btn btn-sm btn-default" @click="showModalForm(clientId, 'NEW_CLIENT_SATURATION_RECORD')">
                                  <span class="fa fa-file-text-o"></span>  New Saturation Record
                                </button>
                            </div>

                            <client-saturations-table :clientId="clientId" :displayOptions="true"></client-saturations-table>
                        </div>
                        
                        <div class="tab-pane fade" id="presentation" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mb-2 mt-2">
                                <button class="btn btn-sm btn-default" @click="showModalForm(clientId, 'NEW_PRESENTATION_RECORD')">
                                  <span class="fa fa-television"></span>  New Presentation Record
                                </button>
                            </div>

                            <client-presentations-table :clientId="clientId" :displayOptions="true"></client-presentations-table>
                        </div>
                        
                        <div class="tab-pane fade" id="acquisition" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mb-2 mt-2">
                                <button class="btn btn-sm btn-default" @click="showModalForm(clientId, 'NEW_CLIENT_ACQUISITION_RECORD')">
                                  <span class="fa fa-handshake-o"></span>  New Acquisition Record
                                </button>
                            </div> 

                            <client-acquisitions-table></client-acquisitions-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal>
            <template slot="header">{{ modalTitle }}</template>
            
            <div v-if="modalFormType == 'NEW_CALL_RECORD' || modalFormType == 'EDIT_CALL_RECORD'">
                <client-calls-form></client-calls-form>
            </div>

            <div v-if="modalFormType == 'NEW_CLIENT_SATURATION_RECORD' || modalFormType == 'EDIT_CLIENT_SATURATION_RECORD'">
                <client-saturation-form></client-saturation-form>
            </div>

            <div v-if="modalFormType == 'NEW_PRESENTATION_RECORD' || modalFormType == 'EDIT_PRESENTATION_RECORD'">
                <client-presentation-form></client-presentation-form>
            </div>

            <div v-if="modalFormType == 'NEW_CLIENT_ACQUISITION_RECORD' || modalFormType == 'EDIT_CLIENT_ACQUISITION_RECORD'">
                <client-acquisition-form></client-acquisition-form>
            </div>
            
        </modal>

        <confirmation-modal>
            <template slot="confirmationHeader"> {{ modalTitle }} </template>
        </confirmation-modal>
    </div>
</template>

<script>
    import ClientPresentationForm from "../../forms/client/ClientPresentationForm";
    import ClientCallsForm from "../../forms/client/ClientCallsForm";
    import ClientSaturationForm from "../../forms/client/ClientSaturationForm";
    import ClientAcquisitionForm from "../../forms/client/ClientAcquisitionForm";
    import  Modal from '../../modal/modal';
    import NavButtons from '../../nav-buttons/NavButtons';
    import {store} from '../../../store/store.js';
    import ClientCallsTable from '../../tables/ClientCallsTable';
    import ClientSaturationsTable from '../../tables/ClientSaturationsTable';
    import ClientPresentationsTable from '../../tables/ClientPresentationsTable';
    import ClientAcquisitionsTable from '../../tables/client/ClientAcquisitionsTable';
    import ConfirmationModal from '../../modal/ConfirmationModal';
    
    export default {
        beforeRouteEnter(to, from, next) {
            let payload = {
                id: to.params.clientId
            };

            store.dispatch('loadClient', payload);
            store.dispatch('loadUsers', 'api/users?type=all');
            store.dispatch('loadCompanies', 'api/companies?type=all');
            store.dispatch('loadModeOfPresentations', 'api/maintenance/mode-of-presentations?type=all');
            store.dispatch('loadPresentationStatuses', 'api/maintenance/presentation-statuses?type=all');
            store.dispatch('loadActionPlans', 'api/maintenance/action-plans?type=all');
            store.dispatch('loadAcquisitions', 'api/maintenance/acquisitions?type=all');
            store.dispatch('loadStatuses', 'api/maintenance/statuses?type=all');
            next();
        },
        created() {
            console.log(this.$route.params.clientId);
            Echo.private("client-channel").listen("ClientEvent", e => {
                console.log(e);
                let payload = {
                    id: this.$route.params.clientId
                };
                //if(this.$route.params.clientId == e.message.client.id){
                    console.log(this.$route.params.clientId + "||" + e.message.client.id)
                    this.$store.dispatch('loadClient', payload);
                    toastr.info('', e.message.response);
                //}
            });
        },
        data(){
            return{
                clientId: this.$route.params.clientId,
                website:''
            };
        },
        computed: {
            client() {
                return this.$store.getters.getClient;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            },
            modalTitle(){
                return this.$store.getters.getModalTitle;
            },
            modalFormType(){
                return this.$store.getters.getModalFormType;
            },
        },
        methods: {
            showModalForm (clientId, type){
                switch (type) {
                    case 'NEW_CALL_RECORD':
                        this.$store.dispatch('setModalTitle', 'Call Details');
                        this.$store.dispatch('setModalFormType', 'NEW_CALL_RECORD');
                        this.$store.dispatch('clearClientCall');
                        
                        break;

                    case 'NEW_CLIENT_SATURATION_RECORD':
                        this.$store.dispatch('setModalTitle', 'Saturation Details');
                        this.$store.dispatch('setModalFormType', 'NEW_CLIENT_SATURATION_RECORD');
                        this.$store.dispatch('clearClientSaturation');
                        break;

                    case 'NEW_PRESENTATION_RECORD':
                        this.$store.dispatch('setModalTitle', 'Presentation Details');
                        this.$store.dispatch('setModalFormType', 'NEW_PRESENTATION_RECORD');
                        this.$store.dispatch('clearClientPresentation');
                        break;

                    case 'NEW_CLIENT_ACQUISITION_RECORD':
                        this.$store.dispatch('setModalTitle', 'Acquisition Details');
                        this.$store.dispatch('setModalFormType', 'NEW_CLIENT_ACQUISITION_RECORD');
                        this.$store.dispatch('clearClientAcquisition');
                        break;    
                    default:
                        break;
                }
                $("#createUserModal").modal("show");
                // alert(clientId);
            },
            checkWebsite() {
                this.website = this.website = this.client.website.indexOf("http") !== -1 || this.client.website.indexOf("https") !== -1 ? this.client.website : 'http://' + this.client.website ;
            }
        },
        components:{
            Modal,
            ClientCallsForm,
            ClientSaturationForm,
            ClientPresentationForm,
            ClientAcquisitionForm,
            NavButtons,
            ClientCallsTable,
            ClientSaturationsTable,
            ClientPresentationsTable,
            ClientAcquisitionsTable,
            ConfirmationModal
        },
        watch: {
            client:  'checkWebsite'
        },
        destroyed() {
            Echo.leave("client-channel");
        }
    };
</script>

<style scoped>
.client-profile {
  position: absolute;
  right: 21px;
}
</style>
