<template>
    <div class="card card-default">
        <div class="card-header bg-white">
            <h4 class="py-2 mb-0">Form Keywords</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="float-left">Companies</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('COMPANY_FORM')">
                                    <span class="fa fa-plus"></span> Add Company
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <companies-table></companies-table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="float-left">Industries</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('INDUSTRY_FORM')">
                                    <span class="fa fa-plus"></span> Add Industry
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <industry-table></industry-table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header clearfix">
                            <h6 class="float-left">Nationalities</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('NATIONALITY_FORM')">
                                    <span class="fa fa-plus"></span> Add Nationality
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <nationalities-table></nationalities-table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="float-left">ISO Certicates</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('ISO_FORM')">
                                    <span class="fa fa-plus"></span> Add Certificate
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <certificates-table></certificates-table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="float-left">Sourcing Practices</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('SOURCING_FORM')">
                                    <span class="fa fa-plus"></span> Add Sourcing Practice
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <sourcing-table></sourcing-table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="float-left">Departments</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('DEPARTMENT_FORM')">
                                    <span class="fa fa-plus"></span> Add Departent
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <departments-table></departments-table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="float-left">Positions</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('POSITION_FORM')">
                                    <span class="fa fa-plus"></span> Add Position
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <positions-table></positions-table>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="float-left">Manpower Types</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('MANPOWER_FORM')">
                                    <span class="fa fa-plus"></span> Add Manpower
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <manpowers-table></manpowers-table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="float-left">User Types</h6>
                            <div class="float-right">
                                <button class="btn btn-sm btn-default" @click="showFormModal('USERTYPE_FORM')">
                                    <span class="fa fa-plus"></span> Add User type
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <user-type-table></user-type-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL SECTION -->
        <modal>
            <template slot="header">{{ modalTitle }}</template>

            <div>
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
    import IndustryTable from '../tables/IndustryTable';
    import NationalitiesTable from '../tables/NationalitiesTable';
    import CertificatesTable from '../tables/CertificatesTable';
    import SourcingTable from '../tables/SourcingTable';
    import DepartmentsTable from '../tables/DepartmentsTable';
    import PositionsTable from '../tables/PositionsTable';
    import ManpowersTable from '../tables/ManpowersTable';
    import UserTypeTable from '../tables/UserTypeTable';
    import CompaniesTable from '../tables/CompaniesTable';
    import Modal from '../modal/modal';
    import ConfirmationModal from '../modal/ConfirmationModal';
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
        mounted(){

        },
        data() {
            return {

            };
        },
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
            modalTitle(){
                return this.$store.getters.getModalTitle;
            },
            modalFormType(){
                return this.$store.getters.getModalFormType;
            },
        },
        methods:{
            showFormModal(scope) {
                switch (scope) {
                    case 'INDUSTRY_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_INDUSTRY').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('industryForm'));
                            this.$store.dispatch('setModalTitle', "Industry Details");
                            this.$store.dispatch('clearIndustry');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'NATIONALITY_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_NATIONALITY').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('nationalityForm'));
                            this.$store.dispatch('setModalTitle', "Nationality Details");
                            this.$store.dispatch('clearNationality');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'ISO_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_ISO').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('isoForm'));
                            this.$store.dispatch('setModalTitle', "ISO Certificate Details");
                            this.$store.dispatch('clearIsoCertificate');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'SOURCING_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_SOURCING_PRACTICE').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('sourcingForm'));
                            this.$store.dispatch('setModalTitle', "Sourcing Practice Details");
                            this.$store.dispatch('clearSourcingPractice');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'DEPARTMENT_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_DEPARTMENT').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('departmentForm'));
                            this.$store.dispatch('setModalTitle', "Department Details");
                            this.$store.dispatch('clearDepartment');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'POSITION_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_POSITION').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('positionForm'));
                            this.$store.dispatch('setModalTitle', "Position Details");
                            this.$store.dispatch('clearPosition');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'MANPOWER_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_MANPOWER').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('manpowerForm'));
                            this.$store.dispatch('setModalTitle', "Manpower Details");
                            this.$store.dispatch('clearManpower');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'USERTYPE_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_USERTYPE').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('userTypeForm'));
                            this.$store.dispatch('setModalTitle', "User type Details");
                            this.$store.dispatch('clearUserType');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'COMPANY_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_COMPANY').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('companyForm'));
                            this.$store.dispatch('setModalTitle', "Company Details");
                            this.$store.dispatch('clearCompany');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    default:
                        break;
                }
            }
        },
        components:{
            IndustryTable,
            NationalitiesTable,
            CertificatesTable,
            SourcingTable,
            DepartmentsTable,
            PositionsTable,
            ManpowersTable,
            UserTypeTable,
            CompaniesTable,
            Modal,
            ConfirmationModal,
            IndustryForm,
            NationalityForm,
            IsoCertificateForm,
            SourcingForm,
            DepartmentForm,
            PositionForm,
            ManpowerForm,
            UserTypeForm,
            CompanyForm
        } 
    }
</script>

<style>

</style>