<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Code</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="companies.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(company, index) in companies.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ company.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ company.company_name }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ company.code }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ company.created_at | humanReadableFormat}}
                    </td>
                    <td style="vertical-align: middle;">
                        <span v-if="company.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="company.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(company)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(company)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="companies" :object="companies" url="api/companies" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadCompanies', 'api/companies');
        },
        computed: {
            companies() {
                return this.$store.getters.getCompanies;
            }
        },  
        methods: {
            edit(company) {
                this.$store.dispatch('setModalFormType', 'EDIT_COMPANY').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit Company');
                    this.$store.dispatch('loadCompany', company);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(company) {
                let deletionType = {
                    scope: "companies",
                    company: company
                };

                this.$store.dispatch('setModalTitle', "Delete " + company.company_name + " ?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            }
        },
        components:{
            Pagination
        }
    }
</script>

<style>

</style>
