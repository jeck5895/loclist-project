<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Target Potential Client</th>
                    <th>Target Calls</th>
                    <th>Target Proposals</th>
                    <th>Target Presentations</th>
                    <th>Target Client to be Acquired</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
    
                <tr v-if="target_lists.data == 0">
                    <td colspan="9" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(target_list, index) in target_lists.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ target_list.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ target_list.report_month.name }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ target_list.target_year }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ target_list.target_increase_potential_client }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ target_list.target_no_of_calls_made }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ target_list.target_proposal_tobe_sent }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ target_list.target_no_formal_presentation }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ target_list.target_client_tobe_acquired }}
                    </td>
                    <!-- <td style="vertical-align: middle;">
                        {{ target_list.created_at | humanReadableFormat}}
                    </td> -->
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(target_list)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(target_list)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="target_lists" :object="target_lists" url="api/reports/target-lists" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../../pagination/Pagination';

    export default {
        beforeCreate () {

        },
        data () {
            return {

            }
        },
        computed: {
            isLoading () {
                return this.$store.getters.getLoadingState;
            },
            target_lists () {
                return this.$store.getters.getTargetLists;
            }
        },
        created () {
            this.$store.dispatch("loadTargetLists","api/reports/target-lists");
        },
        methods: {
            edit(target_list) {
                this.$store.dispatch('setModalFormType', 'EDIT_TARGET_LIST').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit target list');
                    this.$store.dispatch('loadTargetList', target_list);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(target_list) {
                let deletionType = {
                    scope: "target_lists",
                    target_list: target_list
                };

                this.$store.dispatch('setModalTitle', "Delete target list ?");
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
