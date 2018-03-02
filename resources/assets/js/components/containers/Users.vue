<template>
    <div class="col-md-12">
        <nav-buttons></nav-buttons>
        <div class="card card-default bg-white">
            <div class="card-header">
                <strong> <span class="fa fa-users"></span> MANAGE USERS</strong>
            </div>
            <div class="card-body">

                <users-table></users-table>
            </div>
            <modal>
                <template slot="header">{{ modalTitle }}</template>

                <div>
                    <div v-if="modalFormType == 'CREATE_USER' || modalFormType == 'EDIT_USER'">
                        <create-user-form></create-user-form>
                    </div>
                </div>
                
            </modal>
            <confirmation-modal>
                <div slot="confirmationHeader" v-html="modalTitle"> </div>
            </confirmation-modal>
        </div>
    </div>
</template>

<script>
    import UsersTable from '../tables/UsersTable';
    import NavButtons from '../nav-buttons/NavButtons';
    import CreateUserForm from '../forms/user/CreateUserForm';
    import Modal from '../modal/modal';
    import ConfirmationModal from '../modal/ConfirmationModal';

    export default {
        beforeCreate() {
            this.$store.dispatch('setModalFormType', 'CREATE_USER');
        },
        created() {

        },
        computed: {
            currForm(){
                return this.$store.getters.getForm;
            },
            modalFormType(){
                return this.$store.getters.getModalFormType;
            },
            isLoading(){
                return this.$store.getters.getLoadingState;
            },
            modalTitle(){
                return this.$store.getters.getModalTitle;
            },
            authUser() {
                return this.$auth.getter();
            }
        },
        methods: {

        },
        components: {
            UsersTable,
            NavButtons,
            Modal,
            ConfirmationModal,
            CreateUserForm,
        }
    }
</script>

<style>

</style>
