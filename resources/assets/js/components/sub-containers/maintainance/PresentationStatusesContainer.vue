<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Presentation Statuses</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('PRESENTATION_STATUS_FORM')">
                    <span class="fa fa-plus"></span> Add Keyword
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <presentation-statuses-table></presentation-statuses-table>
        </div>
    </div>
</template>

<script>
    import PresentationStatusesTable from '../../tables/maintainance/PresentationStatusesTable';

    export default {
        beforeCreate(){
            this.$store.dispatch('setModalFormType', 'CREATE_PRESENTATION_STATUS');
        },
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_PRESENTATION_STATUS');
                this.$store.dispatch('setForm', document.getElementById('presentationStatusForm'));
                this.$store.dispatch('setModalTitle', "Status Details");
                this.$store.dispatch('clearPresentationStatus');
                this.$store.dispatch('showModal', this.currForm);
            }
        },
        components: {
            PresentationStatusesTable
        }
    }
</script>

<style>

</style>
