<template>
    <div>
        <table id="clients-table" class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Entry By</th>
                    <th style="width: 250px;">Client Name</th>
                    <th style="width: 180px;">Contact Person</th>
                    <th>Contact #</th>
                    <th style="width: 100px;">Email</th>
                    <th>Date of Call</th>
                    <th>Date of Saturation</th>
                    <th>Date of Presentation</th>
                    <th>Follow-up Date</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="isLoading">
                    <td colspan="11" class="text-center">
                    <div v-if="isLoading" class="card-body">
                            <div class="img-loading-container">
                                <img src="/images/spinner.gif" class="img-sm">
                            </div>   
                        </div>
                    </td>
                </tr>
                <tr v-else-if="clients.data == 0">
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
                        {{ client.user.initial }}
                    </td>

                    <!-- Secret -->
                    <td style="vertical-align: middle;">
                        {{ client.client_name }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.contact_person }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.mobile_number }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.email_address }}
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

                            <router-link :to="{ name: 'viewClient', params: { companyName:  toUrlFormat(client.client_name), clientId : client.id }}" class="btn btn-sm btn-default">
                                <span class="fa fa-eye"></span>
                            </router-link>
                            

                            <button type="button" title="Delete" class="btn btn-sm btn-default" @click="destroy(client)">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="clients" :object="clients" url="api/clients"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        mounted() {
            this.$store.dispatch("loadClients", "api/clients");
        },
        data() {
            return {};
        },
        computed: {
            isLoading() {
                return this.$store.getters.getLoadingState;
            },
            clients() {
            return this.$store.getters.getClients;
            }
        },
        methods: {
            toUrlFormat(param) {
                return param.replace(/[^a-zA-Z0-9]/g, "-").toLowerCase();
            },
            view(client) {

            },
            edit(client) {

            },
            destroy(client) {
                
            }
        },
        components:{
            Pagination
        },
        filters: {}
    };
</script>

<style scoped>
    button {
        cursor: pointer;
    }

    #clients-table{
        font-size: 12px;
    }

    .table th,
    .table td {
        padding: 0.25rem;
    }
</style>
