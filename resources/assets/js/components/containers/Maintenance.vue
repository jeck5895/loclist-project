<template>
    <div>
        <div @click="toggleSidebar" :style="!sideBarIsHidden ?'visibility: hidden;':'display: visible; opacity: 1;'" class="sidebar-toggle-hidden">
            <h3 style="cursor: pointer;" class="mt-2"><i class="fa fa-chevron-circle-right"></i></h3>
        </div>
        <div style="position: relative;">
            <sidenav></sidenav>
            <div :style="!sideBarIsHidden ?'margin-left: 12.75rem; transition:margin-left 1s;' : 'margin-left: 0; transition:margin-left 1s;'">
                <router-view></router-view>
                <!-- MODAL SECTION -->
                <modal>
                    <template slot="header">{{ modalTitle }}</template>

                    <div>
                        <div v-if="modalFormType == 'CREATE_COMPANY' || modalFormType == 'EDIT_COMPANY'">
                            <company-form></company-form>
                        </div>
                        <div v-if="modalFormType == 'CREATE_STATUS' || modalFormType == 'EDIT_STATUS'">
                            <status-form></status-form>
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
                        <div v-if="modalFormType == 'CREATE_SATURATION' || modalFormType == 'EDIT_SATURATION'">
                            <saturation-form></saturation-form>
                        </div>
                        <div v-if="modalFormType == 'CREATE_CONFIRMATION' || modalFormType == 'EDIT_CONFIRMATION'">
                            <confirmation-form></confirmation-form>
                        </div>
                        <div v-if="modalFormType == 'CREATE_MODE_OF_PRESENTATION' || modalFormType == 'EDIT_MODE_OF_PRESENTATION'">
                            <mode-of-presentation-form></mode-of-presentation-form>
                        </div>
                        <div v-if="modalFormType == 'CREATE_PRESENTATION_STATUS' || modalFormType == 'EDIT_PRESENTATION_STATUS'">
                            <presentation-status-form></presentation-status-form>
                        </div>
                        <div v-if="modalFormType == 'CREATE_ACTION_PLAN' || modalFormType == 'EDIT_ACTION_PLAN'">
                            <action-plan-form></action-plan-form>
                        </div>
                        <div v-if="modalFormType == 'CREATE_ACQUISITION' || modalFormType == 'EDIT_ACQUISITION'">
                            <acquisition-form></acquisition-form>
                        </div>
                        <div v-if="modalFormType == 'CREATE_TARGET_LIST' || modalFormType == 'EDIT_TARGET_LIST'">
                            <target-list-form></target-list-form>
                        </div>
                    </div>
                </modal>

                <confirmation-modal>
                    <template slot="confirmationHeader"> {{ modalTitle }} </template>
                </confirmation-modal>
            </div>
        </div>
    </div>
</template>

<script>
    
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
    import StatusForm from '../forms/maintainance/StatusForm';
    import SaturationForm from '../forms/maintainance/SaturationForm';
    import ConfirmationForm from '../forms/maintainance/ConfirmationForm';
    import ModeOfPresentationForm from '../forms/maintainance/ModeOfPresentationForm';
    import PresentationStatusForm from '../forms/maintainance/PresentationStatusForm';
    import ActionPlanForm from '../forms/maintainance/ActionPlanForm';
    import AcquisitionForm from '../forms/maintainance/AcquisitionForm';
    import TargetListForm from '../forms/report/TargetListForm';
    import Sidenav from '../navs/Sidenav';

    export default {
        created(){
    
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
            sideBarIsHidden() {
                return this.$store.getters.getSideBarState;
            }
        },
        methods:{
            toggleSidebar(){
                if(this.sideBarIsHidden){
                    this.$store.dispatch('setSideBarState', false);
                }
                else{
                    this.$store.dispatch('setSideBarState', true);
                }
            }
        },
        components:{
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
            CompanyForm,
            StatusForm,
            SaturationForm,
            ConfirmationForm,
            ModeOfPresentationForm,
            PresentationStatusForm,
            ActionPlanForm,
            AcquisitionForm,
            TargetListForm,
            Sidenav
        } 
    }
</script>

<style scoped>
    .sidebar-toggle-hidden{
        position: absolute;
        border: 1px solid #ccc;
        height: 43px;
        width: 30px;
        border-bottom-right-radius: 5px;
        border-top-right-radius: 5px;
        z-index: 1000;
        left: 0;
        top: -1.5rem;
        opacity: 0;
        transition: visibility 1s, opacity 2s linear;
    }
</style>