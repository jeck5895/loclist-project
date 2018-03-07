<template>
    <div>
        <div class="card card-default">
            <div class="card-header">
                <h4 class="float-left">Target List for KPI Report</h4>
                <div class="float-right">
                    <button class="btn btn-sm btn-default" @click="showFormModal('CREATE_TARGET_LIST')">
                        <span class="fa fa-plus"></span> SET TARGET GOALS
                    </button>
                </div>
            </div>
            <div class="card-body">
                <target-list-table></target-list-table>
            </div>
        </div>
    </div>
</template>

<script>
    import TargetListTable from '../../tables/reports/TargetListTable';

    export default {
        beforeCreate(){
            this.$store.dispatch('setModalFormType', 'CREATE_TARGET_LIST');
        },
        created() {
            this.loadReportMonths();
        },
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', scope);
                this.$store.dispatch('setForm', document.getElementById('targetListForm'));
                this.$store.dispatch('setModalTitle', "TARGET LIST DETAILS");
                this.$store.dispatch('clearTargetList');
                this.$store.dispatch('showModal', this.currForm);
                // console.log(this.$data)
            },
            loadReportMonths() {
                this.$store.dispatch('loadReportMonths', 'api/reports/report-months');
            },
        },
        components: {
            TargetListTable
        }
    }
</script>

<style>

</style>
