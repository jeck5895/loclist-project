<template>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><strong>CLIENTS</strong></a>
            </li>
            <li v-if="authUser.userType == 1"class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#users" role="tab"><strong>MANAGE USERS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#definition" role="tab"><strong>DEFINITION OF TERMS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reports" role="tab"><strong>REPORTS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><strong>SETTINGS</strong></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <clients-nav-button></clients-nav-button>
                <div class="row mb-2">
                    <div class="col">
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
                This is Report Tab
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                This is Settings
            </div>
        </div>
        <modal>
            <template slot="header">{{ modalTitle }}</template>
            <create-user-form></create-user-form>
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

    export default {
        mounted() {

        },
        data(){
            return {
                
            }
        },
        computed:{
            modalTitle(){
                return this.$store.getters.getModalTitle;
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
            ClientsFilter
        }
    }
</script>
<style scoped>
    .nav-tabs .nav-link{
        border:none;
    }
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{
        border-bottom: 3px solid #549eff;
        background: transparent;
    }
</style>
