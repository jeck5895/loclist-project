<template>
    <div>
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Client </th>
                    <th>Remarks</th>
                    <th>Entry Date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="isLoading">
                    <td colspan="11" class="text-center">
                        <div class="img-loading-container">
                            <img src="/images/spinner.gif" class="img-sm">
                        </div>
                    </td>
                </tr>
                <tr v-else-if="clients.data == 0">
                    <td colspan="3" class="text-center">
                        <em>No data to show...</em>
                    </td>
                </tr>
                <tr v-else v-for="(client, index) in clients.data" :key="index">
                    <td style="vertical-align: middle;">
                        {{ client.id }}
                    </td> 

                    <td style="vertical-align: middle;">
                        {{ client.client_name }}
                    </td> 

                    <td style="vertical-align: middle;">
                        <em>This client does not have call history. 
                            <router-link :to="{ name: 'viewClient', params: { companyName:  $root.toUrlFormat(client.client_name), clientId : client.id}, hash:'#call-records'}"
                                :target="client.id">
                                Create
                            </router-link>    
                         call record now!</em>
                    </td> 

                    <td style="vertical-align: middle;">
                        {{ client.created_at | humanReadableFormat }}
                    </td> 
                </tr>
            </tbody>
        </table>
        <pagination
            scope="clients_to_call"
            url="api/clients/clients-to-call"
            :object="clients"
            classSize="pagination-sm"
        ></pagination>
    </div>
</template>

<script>
    import Pagination from '../../pagination/Pagination';

    export default {
        created() {
            this.loadClientsToCall();
        },
        computed: {
            isLoading() {
                return this.$store.getters.getToCallLoadingState;
            },
            clients() {
                return this.$store.getters.getClientsToCall;
            }
        },
        methods: {
            loadClientsToCall() {
                this.$store.dispatch('loadClientsToCall', 'api/clients/clients-to-call');
            }
        },
        components: {
            Pagination
        }
    }
</script>

<style>

</style>
