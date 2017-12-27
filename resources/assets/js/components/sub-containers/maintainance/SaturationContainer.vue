<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Mode of Saturations</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('SATURATION_FORM')">
                    <span class="fa fa-plus"></span> Add Saturation
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <saturations-table></saturations-table>
        </div>
    </div>
</template>

<script>
    import SaturationsTable from '../../tables/SaturationsTable';
    export default {
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_SATURATION').then(() => {
                    this.$store.dispatch('setForm', document.getElementById('saturationForm'));
                    this.$store.dispatch('setModalTitle', "Mode of Saturation Details");
                    this.$store.dispatch('clearSaturation');
                    this.$store.dispatch('showModal', this.currForm);
                });
            }
        },
        components: {
            SaturationsTable
        }
    }
</script>

<style>

</style>
