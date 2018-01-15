<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Action Plans</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('ACTION_PLAN_FORM')">
                    <span class="fa fa-plus"></span> Add Action Plan
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <action-plans-table></action-plans-table>
        </div>
    </div>
</template>

<script>
    import ActionPlansTable from '../../tables/maintainance/ActionPlansTable';

    export default {
        beforeCreate() {
            this.$store.dispatch('setModalFormType', 'CREATE_ACTION_PLAN')
        },
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_ACTION_PLAN');
                this.$store.dispatch('setForm', document.getElementById('actionPlanForm'));
                this.$store.dispatch('setModalTitle', "Action Plan Details");
                this.$store.dispatch('clearActionPlan');
                this.$store.dispatch('showModal', this.currForm);
            }
        },
        components: {
            ActionPlansTable
        }
    }
</script>

<style>

</style>
