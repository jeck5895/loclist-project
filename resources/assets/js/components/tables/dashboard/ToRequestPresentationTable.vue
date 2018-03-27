<template>
    <div>
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Client </th>
                    <th>Remarks</th>
                    <!-- <th></th>
                    <th></th> -->
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
                        <em>This client doesn't have presentation records.</em>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination
            scope="clients_to_request_presentation"
            url="api/clients/clients-to-request-for-formal-presentation"
            :object="clients"
            classSize="pagination-sm"
        ></pagination>
    </div>
</template>

<script>
    import Pagination from '../../pagination/Pagination';

    export default {
        created() {
            this.loadClientsToRequestPresentation();
        },
        computed: {
            clients() {
                return this.$store.getters.getClientsToRequestPresentation;
            },
            isLoading() {
                return this.$store.getters.getToRequestPresentationLoadingState;
            }
        },
        methods : {
            loadClientsToRequestPresentation() {
                this.$store.dispatch('loadClientsToRequestPresentation', 'api/clients/clients-to-request-for-formal-presentation');
            }
        },
        components : {
            Pagination
        }
    }
</script>

<style>

</style>
