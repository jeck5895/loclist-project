<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Industry</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="industry in industries.data" :key="industry.id">
                   <td style="vertical-align: middle;">
                        {{ industry.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ industry.industry_name }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ industry.created_at | humanReadableFormat}}
                    </td>
                    <td style="vertical-align: middle;">
                        <span v-if="industry.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="industry.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(industry)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <!-- <button type="button" title="View" class="btn btn-sm btn-default" @click="view(industry)">
                                <span class="fa fa-eye"></span>
                            </button> -->

                            <button @click="destroy(industry)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="industries" :object="industries" url="api/industries" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
import Pagination from '../pagination/Pagination';

export default {
    mounted() {
        this.$store.dispatch('loadIndustries','api/industries');
    },
    computed: {
        industries() {
            return this.$store.getters.getIndustries;
        }
    },
    methods: {
        edit(industry) {
            this.$store.dispatch('setModalFormType', 'EDIT_INDUSTRY').then(() => {
                this.$store.dispatch('setModalTitle', 'Edit Industry');
                this.$store.dispatch('loadIndustry', industry);  
                $("#createUserModal").modal("show");
            });
        },
        destroy(industry) {
            let deletionType = {
                    scope: "industries",
                    industry: industry
                };

            this.$store.dispatch('setModalTitle', "Delete " + industry.industry_name + " ?");
            this.$store.dispatch('setDeletionType', deletionType);
            this.$store.dispatch('showConfirmationModal');
        }
    },
    filters:{
        
    },
    components:{
        Pagination
    }
}
</script>

<style>

</style>
