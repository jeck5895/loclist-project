<template>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" role="tab"> <strong> <span class="fa fa-briefcase"></span> CLIENTS</strong></a>
            </li>
            <li v-if="authUser.userType == 1"class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#users" role="tab"><strong> <span class="fa fa-users"></span> MANAGE USERS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#definition" role="tab"><strong> <span class="fa fa-book"></span> DEFINITION OF TERMS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reports" role="tab"><strong> <span class="fa fa-bar-chart"></span> REPORTS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><strong> <span class="fa fa-gears"></span> MAINTENANCE</strong></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                
                <div class="row">
                    <div class="col-sm-4 mr-auto">
                        <clients-nav-button></clients-nav-button>
                    </div>
                    <div class="col-sm-4">
                        <clients-filter></clients-filter>
                    </div>
                </div>
                <clients-table></clients-table>
            </div>
            <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                <users-nav-button></users-nav-button>
                <users-table></users-table>
            </div>
            <div class="tab-pane fade" id="definition" role="tabpanel" aria-labelledby="profile-tab">
                This is Definition of Terms Tab
            </div>
            <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Design UI for 2 types of reports
                            </div>
                            <div class="card-body">
                                KPI REPORT 
                                Quarterly
                                Weekly
                                Annulay
                                with date Filters
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <maintainance></maintainance>
            </div>
        </div>
        <modal>
            <template slot="header">{{ modalTitle }}</template>
            <!-- This condition displays what form/data should be display -->
            <div v-if="modalFormType == 'EditUser' || modalFormType == 'CreateUser'">
                <create-user-form></create-user-form>
            </div>
            <div v-if="modalFormType == 'CREATE_INDUSTRY' || modalFormType == 'EDIT_INDUSTRY'">
                <industry-form></industry-form>
            </div>
            <div v-if="modalFormType == 'CREATE_NATIONALITY' || modalFormType == 'EDIT_NATIONALITY'">
                <nationality-form></nationality-form>
            </div>
            <div v-if="modalFormType == 'EditClient'">
                <label for="">Edit Client</label>
            </div>
        </modal>
        <confirmation-modal>
            <template slot="confirmationHeader"> {{ modalTitle }} </template>
        </confirmation-modal>
    </div>
</template>

<script>
    import clientsTable from '../tables/clientsTable.vue';
    import UsersTable from '../tables/UsersTable.vue';
    import ClientsNavButton from '../nav-buttons/ClientsNavButton';
    import UsersNavButton from '../nav-buttons/UsersNavButton';
    import Modal from '../modal/modal';
    import ConfirmationModal from '../modal/ConfirmationModal';
    import CreateUserForm from '../forms/CreateUserForm';
    import ClientsFilter from '../filters/ClientsFilter';
    import Maintainance from '../containers/Maintainance';
    import IndustryForm from '../forms/IndustryForm';
    import NationalityForm from '../forms/NationalityForm';

    export default {
        mounted() {
            console.log(this.modalFormType)
        },
        data(){
            return {
                
            }
        },
        computed:{
            modalTitle(){
                return this.$store.getters.getModalTitle;
            },
            modalFormType(){
                return this.$store.getters.getModalFormType;
            },
            authUser() {
                return this.$auth.getter();
            }
        },
        components:{
            clientsTable,
            UsersTable,
            ClientsNavButton,
            UsersNavButton,
            Modal,
            ConfirmationModal,
            CreateUserForm,
            ClientsFilter,
            Maintainance,
            IndustryForm,
            NationalityForm
        },
        filters:{
            humanReadableFormat(date) {
                return moment(date).format('MMMM Do, YYYY');
            }
        }
    }
</script>
<style scoped>
    a {
        color: #495057; 
    }
</style>
