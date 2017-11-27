<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nationality</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="nationality in nationalities.data" :key="nationality.id">
                    <td style="vertical-align: middle;">
                        {{ nationality.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ nationality.nationality}}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ nationality.created_at | humanReadableFormat}}
                    </td>
                    <td style="vertical-align: middle;">
                        <span v-if="nationality.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="nationality.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(nationality)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <!-- <button type="button" title="View" class="btn btn-sm btn-default" @click="view(industry)">
                                <span class="fa fa-eye"></span>
                            </button> -->

                            <button @click="destroy(nationality)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="nationalities" :object="nationalities" url="api/nationalities" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadNationalities','api/nationalities');
        },
        computed: {
            nationalities() {
                return this.$store.getters.getNationalities;
            },
        },
        methods: {
            edit(nationality) {
                this.$store.dispatch('setModalFormType', 'EDIT_NATIONALITY').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit Nationality');
                    this.$store.dispatch('loadNationality', nationality);  
                    $("#createUserModal").modal("show");
                });
            },
            destroy(nationality) {

            }
        },
        components: {
            Pagination
        },
        filters:{
            humanReadableFormat(date) {
                return moment(date).format('MMMM Do, YYYY');
            }
        }
    }
</script>

<style>

</style>
