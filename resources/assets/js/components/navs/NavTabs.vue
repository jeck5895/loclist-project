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
                        <nav-buttons></nav-buttons>
                    </div>
                    <div class="col-sm-6">
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
            <div v-if="isLoading" class="row">
                <div class="img-loading-container">
                    <img src="/images/spinner.gif">
                </div>
            </div>
            <div v-if="!isLoading">
                <div v-if="modalFormType == 'EditUser' || modalFormType == 'CreateUser'">
                    <create-user-form></create-user-form>
                </div>
                <div v-if="modalFormType == 'CREATE_COMPANY' || modalFormType == 'EDIT_COMPANY'">
                    <company-form></company-form>
                </div>
                <div v-if="modalFormType == 'CREATE_INDUSTRY' || modalFormType == 'EDIT_INDUSTRY'">
                    <industry-form></industry-form>
                </div>
                <div v-if="modalFormType == 'CREATE_NATIONALITY' || modalFormType == 'EDIT_NATIONALITY'">
                    <nationality-form></nationality-form>
                </div>
                <div v-if="modalFormType == 'CREATE_ISO' || modalFormType == 'EDIT_ISO'">
                    <iso-certificate-form></iso-certificate-form>
                </div>
                <div v-if="modalFormType == 'CREATE_SOURCING_PRACTICE' || modalFormType == 'EDIT_SOURCING_PRACTICE'">
                    <sourcing-form></sourcing-form>
                </div>
                <div v-if="modalFormType == 'CREATE_DEPARTMENT' || modalFormType == 'EDIT_DEPARTMENT'">
                    <department-form></department-form>
                </div>
                <div v-if="modalFormType == 'CREATE_POSITION' || modalFormType == 'EDIT_POSITION'">
                    <position-form></position-form>
                </div>
                <div v-if="modalFormType == 'CREATE_MANPOWER' || modalFormType == 'EDIT_MANPOWER'">
                    <manpower-form></manpower-form>
                </div>
                <div v-if="modalFormType == 'CREATE_USERTYPE' || modalFormType == 'EDIT_USERTYPE'">
                    <user-type-form></user-type-form>
                </div>
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
    import NavButtons from '../nav-buttons/NavButtons';
    import UsersNavButton from '../nav-buttons/UsersNavButton';
    import Modal from '../modal/modal';
    import ConfirmationModal from '../modal/ConfirmationModal';
    import CreateUserForm from '../forms/user/CreateUserForm';
    import ClientsFilter from '../filters/ClientsFilter';
    import Maintainance from '../containers/Maintainance';
    import IndustryForm from '../forms/maintainance/IndustryForm';
    import NationalityForm from '../forms/maintainance/NationalityForm';
    import IsoCertificateForm from '../forms/maintainance/IsoCertificateForm';
    import SourcingForm from '../forms/maintainance/SourcingForm';
    import DepartmentForm from '../forms/maintainance/DepartmentForm';
    import PositionForm from '../forms/maintainance/PositionForm';
    import ManpowerForm from '../forms/maintainance/ManpowerForm';
    import UserTypeForm from '../forms/maintainance/UserTypeForm';
    import CompanyForm from '../forms/company/CompanyForm';

    export default {
        mounted() {
            // console.log(this.modalFormType)
        },
        data(){
            return {
                
            }
        },
        computed:{
            isLoading(){
                return this.$store.getters.getLoadingState;
            },
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
            NavButtons,
            UsersNavButton,
            Modal,
            ConfirmationModal,
            CreateUserForm,
            ClientsFilter,
            Maintainance,
            IndustryForm,
            NationalityForm,
            IsoCertificateForm,
            SourcingForm,
            DepartmentForm,
            PositionForm,
            ManpowerForm,
            UserTypeForm,
            CompanyForm
        },
        filters:{
            
        }
    }
</script>
<style scoped>
    a {
        color: #495057; 
    }
</style>
