<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Presentation status</th>
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

                <tr v-if="presentation_statuses.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(presentation_status, index) in presentation_statuses.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ presentation_status.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ presentation_status.status }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ presentation_status.created_at | humanReadableFormat}}
                    </td>
                    <!-- <td style="vertical-align: middle;">
                        <span v-if="presentation_status.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="presentation_status.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td> -->
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(presentation_status)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(presentation_status)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="presentation_statuses" :object="presentation_statuses" url="api/maintainance/mode-of-presentations" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadPresentationStatuses','api/maintenance/presentation-statuses');
        },
        computed: {
            presentation_statuses() {
                return this.$store.getters.getPresentationStatuses;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            }
        },
        methods: {
            edit(presentation_status) {
                this.$store.dispatch('setModalFormType', 'EDIT_PRESENTATION_STATUS').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit presentation status');
                    this.$store.dispatch('loadPresentationStatus', presentation_status);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(presentation_status) {
                let deletionType = {
                    scope: "presentation_statuses",
                    presentation_status: presentation_status
                };

                this.$store.dispatch('setModalTitle', "Delete " + presentation_status.status + " ?");
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
