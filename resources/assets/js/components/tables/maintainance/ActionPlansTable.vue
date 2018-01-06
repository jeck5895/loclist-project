<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Action Plan</th>
                    <th>Date Created</th>
                    <!-- <th>Status</th> -->
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-if="isLoading">
                    <td colspan="11" class="text-center">
                    <div v-if="isLoading" class="card-body">
                            <div class="img-loading-container">
                                <img src="/images/spinner.gif" class="img-sm">
                            </div>   
                        </div>
                    </td>
                </tr> -->

                <tr v-if="action_plans.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(action_plan, index) in action_plans.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ action_plan.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ action_plan.action_name }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ action_plan.created_at | humanReadableFormat}}
                    </td>
                    <!-- <td style="vertical-align: middle;">
                        <span v-if="action_plan.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="action_plan.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td> -->
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(action_plan)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(action_plan)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="action_plans" :object="action_plans" url="api/maintainance/mode-of-presentations" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadActionPlans','api/maintainance/action-plans');
        },
        computed: {
            action_plans() {
                return this.$store.getters.getActionPlans;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            }
        },
        methods: {
            edit(action_plan) {
                this.$store.dispatch('setModalFormType', 'EDIT_ACTION_PLAN').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit action plan');
                    this.$store.dispatch('loadActionPlan', action_plan);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(action_plan) {
                let deletionType = {
                    scope: "action_plans",
                    action_plan: action_plan
                };

                this.$store.dispatch('setModalTitle', "Delete " + action_plan.action_name + " ?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            }
        },
        components: {   
            Pagination
        }
    }
</script>

<style>

</style>
