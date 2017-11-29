<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sources Practice</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="practices.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>
                <tr v-else v-for="practice in practices.data" :key="practice.id">
                   <td style="vertical-align: middle;">
                        {{ practice.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ practice.name }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ practice.created_at | humanReadableFormat}}
                    </td>
                    <td style="vertical-align: middle;">
                        <span v-if="practice.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="practice.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(practice)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(practice)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="sourcing_practices" :object="practices" url="api/sourcing_practices" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadSourcingPractices', 'api/sourcing_practices');
        },
        computed: {
            practices() {
                return this.$store.getters.getSourcingPratices;
            }
        },
        methods: {
            edit(sourcing_practice) {
                this.$store.dispatch('setModalFormType', 'EDIT_SOURCING_PRACTICE').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit Sourcing Practice');
                    this.$store.dispatch('loadSourcingPractice', sourcing_practice);  
                    $("#createUserModal").modal("show");
                });
            },
            destroy(sourcing_practice) {
                let deletionType = {
                    scope: "sourcing_practice",
                    sourcing_practice: sourcing_practice
                };

                this.$store.dispatch('setModalTitle', "Delete " + sourcing_practice.name + " ?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            }
        },
        filters: {

        },
        components: {
            Pagination
        }
    }
</script>

<style>

</style>
