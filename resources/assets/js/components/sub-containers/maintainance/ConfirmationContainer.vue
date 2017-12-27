<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Manner of Confirmation</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('DEPARTMENT_FORM')">
                    <span class="fa fa-plus"></span> Add Confirmation code
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <confirmations-table></confirmations-table>
        </div>
    </div>
</template>

<script>
    import ConfirmationsTable from '../../tables/ConfirmationsTable';
    export default {
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_CONFIRMATION').then(() => {
                    this.$store.dispatch('setForm', document.getElementById('confirmationForm'));
                    this.$store.dispatch('setModalTitle', "Manner of Confirmation Details");
                    this.$store.dispatch('clearConfirmation');
                    this.$store.dispatch('showModal', this.currForm);
                });
            }
        },
        components: {
            ConfirmationsTable
        }
    }
</script>

<style>

</style>
