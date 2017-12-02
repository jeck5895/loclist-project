<template>
    <table id="clients-table" class="table table-borderless table-striped m-b-none">
        <thead>
            <tr>
                <th>Ref</th>
                <th>Entry By</th>
                <th>Client Name</th>
                <th>Contact Person</th>
                <th>Contact #</th>
                <th>Email</th>
                <th>Date of Call</th>
                <th>Date of Saturation</th>
                <th>Date of Presentation</th>
                <th>Follow-up Date</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="clients.data == 0">
                    <td colspan="11" class="text-center">
                        No data to show...
                    </td>
                </tr>
            <tr v-else v-for="(client, index) in clients.data" :key="index">
                <!-- ID -->
                <td style="vertical-align: middle;">
                    {{ client.id }}
                </td>

                <!-- Name -->
                <td style="vertical-align: middle;">
                    {{ client.entry_by }}
                </td>

                <!-- Secret -->
                <td style="vertical-align: middle;">
                    {{ client.client_name }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.contact_person }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.contact_no }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.email }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.date_call }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.saturation_date }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.presentation_date }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.followup_date }}
                </td>

                <!-- Edit Button -->
                <td style="vertical-align: middle;">
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(client)">
                            <span class="fa fa-edit"></span>
                        </button>

                        <router-link :to="{ name: 'viewClient', params: { clientId : toUrlFormat(client.client_name) + '-' + client.id }}" class="btn btn-sm btn-default">
                            <span class="fa fa-eye"></span>
                        </router-link>
                        <!-- <button type="button" title="View" class="btn btn-sm btn-default" @click="view(client)">
                            <span class="fa fa-eye"></span>
                        </button> -->

                        <button type="button" title="Delete" class="btn btn-sm btn-default" @click="destroy(client)">
                            <span class="fa fa-trash"></span>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch('loadClients', 'api/clients')
    },
    data() {
        return {

        }
    },
    computed: {
        clients() {
            return this.$store.getters.getClients;
        }
    },
    methods: {
        toUrlFormat(param){
            return param.replace(/[^a-zA-Z0-9]/g, '-').toLowerCase();
        },
        view(client){
			
        },
        edit(client) {

        },
        destroy(client) {
    
        }
    },
    filters: {
        
    }
}
</script>

<style scoped>
    button {
        cursor: pointer;
    }
    
    .table th, .table td{
        padding: 0.25rem;
    }
</style>
