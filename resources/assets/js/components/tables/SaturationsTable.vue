<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Saturation mode</th>
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

                <tr v-if="saturations.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(saturation, index) in saturations.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ saturation.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ saturation.saturation_mode }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ saturation.created_at | humanReadableFormat}}
                    </td>
                    <!-- <td style="vertical-align: middle;">
                        <span v-if="saturation.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="saturation.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td> -->
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(saturation)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(saturation)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="saturations" :object="saturations" url="api/maintenance/saturations" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadSaturations','api/maintenance/saturations');
        },
        computed: {
            saturations() {
                return this.$store.getters.getSaturations;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            }
        },
        methods: {
            edit(saturation) {
                this.$store.dispatch('setModalFormType', 'EDIT_SATURATION').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit Saturation');
                    this.$store.dispatch('loadSaturation', saturation);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(saturation) {
                let deletionType = {
                    scope: "saturations",
                    saturation: saturation
                };

                this.$store.dispatch('setModalTitle', "Delete " + saturation.saturation_mode + " ?");
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
