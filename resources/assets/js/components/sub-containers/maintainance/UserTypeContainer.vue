<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">User Types</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('USERTYPE_FORM')">
                    <span class="fa fa-plus"></span> Add User type
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <user-type-table></user-type-table>
        </div>
    </div>
</template>

<script>
    import UserTypeTable from '../../tables/UserTypeTable';
    export default {
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_USERTYPE').then(() => {
                    this.$store.dispatch('setForm', document.getElementById('userTypeForm'));
                    this.$store.dispatch('setModalTitle', "User type Details");
                    this.$store.dispatch('clearUserType');
                    this.$store.dispatch('showModal', this.currForm);
                });
            }
        },
        components: {
            UserTypeTable
        }
    }
</script>

<style>

</style>
