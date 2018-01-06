<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Presentation mode</th>
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

                <tr v-if="mode_of_presentations.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(mode_of_presentation, index) in mode_of_presentations.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ mode_of_presentation.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ mode_of_presentation.presentation_mode }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ mode_of_presentation.created_at | humanReadableFormat}}
                    </td>
                    <!-- <td style="vertical-align: middle;">
                        <span v-if="mode_of_presentation.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="mode_of_presentation.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td> -->
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(mode_of_presentation)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(mode_of_presentation)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="mode_of_presentations" :object="mode_of_presentations" url="api/maintainance/mode-of-presentations" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadModeOfPresentations','api/maintainance/mode-of-presentations');
        },
        computed: {
            mode_of_presentations() {
                return this.$store.getters.getModeOfPresentations;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            }
        },
        methods: {
            edit(mode_of_presentation) {
                this.$store.dispatch('setModalFormType', 'EDIT_MODE_OF_PRESENTATION').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit mode of presentation');
                    this.$store.dispatch('loadModeOfPresentation', mode_of_presentation);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(mode_of_presentation) {
                let deletionType = {
                    scope: "mode_of_presentations",
                    mode_of_presentation: mode_of_presentation
                };

                this.$store.dispatch('setModalTitle', "Delete " + mode_of_presentation.presentation_mode + " ?");
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
