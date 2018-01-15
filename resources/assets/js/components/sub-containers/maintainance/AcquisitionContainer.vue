<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Manner of Acquisitions</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('ACQUISITION_FORM')">
                    <span class="fa fa-plus"></span> Add Acquisition code
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <acquisitions-table></acquisitions-table>
        </div>
    </div>
</template>

<script>
    import AcquisitionsTable from '../../tables/maintainance/AcquisitionsTable';
    export default {
        beforeCreate(){
            this.$store.dispatch('setModalFormType', 'CREATE_ACQUISITION');
        },
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_ACQUISITION')
                this.$store.dispatch('setForm', document.getElementById('acquisitionForm'));
                this.$store.dispatch('setModalTitle', "Manner of Acquisition Details");
                this.$store.dispatch('clearAcquisition');
                this.$store.dispatch('showModal', this.currForm);
            }
        },
        components: {
            AcquisitionsTable
        }
    }
</script>

<style>

</style>
