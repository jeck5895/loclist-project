<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Manpower Type</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="manpowers.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(manpower, index) in manpowers.data" :key="index">
                    <td style="vertical-align: middle;">
                        {{ manpower.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ manpower.type}}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ manpower.created_at | humanReadableFormat}}
                    </td>
                    <td style="vertical-align: middle;">
                        <span v-if="manpower.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="manpower.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(manpower)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(manpower)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="manpowers" :object="manpowers" url="api/manpowers" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';
    export default {
        mounted() {
            this.$store.dispatch('loadManpowers', 'api/manpowers');
        },
        computed: {
            manpowers() {
                return this.$store.getters.getManpowers;
            }
        },
        methods: {
            edit(manpower) {
                this.$store.dispatch('setModalFormType', 'EDIT_MANPOWER').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit Manpower');
                    this.$store.dispatch('loadManpower', manpower);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(manpower) {
                let deletionType = {
                    scope: "manpowers",
                    manpower: manpower
                };

                this.$store.dispatch('setModalTitle', "Delete " + manpower.type + " ?");
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
