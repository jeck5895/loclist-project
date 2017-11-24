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
                        <span class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(industry)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button type="button" title="View" class="btn btn-sm btn-default" @click="view(industry)">
                                <span class="fa fa-eye"></span>
                            </button>

                            <button @click="destroy(industry)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch('loadIndustries');
        console.log(this.industries)
    },
    computed: {
        industries() {
            return this.$store.getters.getIndustries;
        }
    },
    methods: {

    },
    filters:{
        transformStatus(status) {
            return status == 1 ? `<span>`:'' ;
        },
        humanReadableFormat(date) {
            return moment(date).format('MMMM Do, YYYY');
        }
    }
}
</script>

<style>

</style>
