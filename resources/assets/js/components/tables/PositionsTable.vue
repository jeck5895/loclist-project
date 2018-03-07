<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Date Created</th>
                    <th>Status</th>
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
                <tr v-if="positions.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(position, index) in positions.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ position.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ position.position_name }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ position.department != null ? position.department.department_name :'' }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ position.created_at | humanReadableFormat}}
                    </td>
                    <td style="vertical-align: middle;">
                        <span v-if="position.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="position.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(position)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(position)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="positions" :object="positions" url="api/maintenance/positions" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadPositions', 'api/maintenance/positions');
        },
        computed: {
            positions() {
                return this.$store.getters.getPositions;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            }
        },
        methods: {
            edit(position) {
                this.$store.dispatch('setModalFormType', 'EDIT_POSITION').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit Position');
                    this.$store.dispatch('loadPosition', position);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(position) {
                let deletionType = {
                    scope: "positions",
                    position: position
                };

                this.$store.dispatch('setModalTitle', "Delete " + position.position_name + " ?");
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
