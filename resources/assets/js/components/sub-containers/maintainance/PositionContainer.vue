<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Positions</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('POSITION_FORM')">
                    <span class="fa fa-plus"></span> Add Position
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <positions-table></positions-table>
        </div>
    </div>
</template>

<script>
    import PositionsTable from '../../tables/PositionsTable';
    export default {
        computed: {
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_POSITION').then(() => {
                    this.$store.dispatch('setForm', document.getElementById('positionForm'));
                    this.$store.dispatch('setModalTitle', "Position Details");
                    this.$store.dispatch('clearPosition');
                    this.$store.dispatch('showModal', this.currForm);
                });
            }
        },
        components: {
            PositionsTable
        }
    }
</script>

<style>

</style>