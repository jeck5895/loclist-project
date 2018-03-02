<template>
    <div>
        <table class="table table-borderless table-striped m-b-none calls-table">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Acquired by</th>
                    <th>Status as of</th>
                    <th>Status</th>
                    <th>Date Acquired</th>
                    <th>Company</th>
                    <th>Signed Contract</th>
                    <th>Manner of Acquisition</th>
                    <th>Intitial HC Req.</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-if="isLoading">
                    <td colspan="11" class="text-center">
                    <div v-if="isLoading" class="card-body">
                            <div class="img-loading-container">
                     ,            <img src="/images/spinner.gif" class="img-sm">
                            </div>   
                        </div>
                    </td>
                </tr> -->

                <tr v-if="acquisitions.data == 0">
                    <td colspan="11" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(acquisition, index) in acquisitions.data" :key="index">
                   <!-- <td style="vertical-align: middle;">
                        {{ acquisition.id }}
                    </td> -->
                    <td style="vertical-align: middle;">
                        {{ acquisition.user.initial }}
                    </td>
                    
                    <td style="vertical-align: middle;">
                        {{ acquisition.status_as_of|humanReadableFormat }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ acquisition.status.status }}
                    </td>

                    <td v-if="acquisition.date_acquired == null" style="vertical-align: middle;">
                        N/A
                    </td>

                    <td v-else style="vertical-align: middle;">
                        {{ acquisition.date_acquired|humanReadableFormat }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ acquisition.company.code }}
                    </td>
                   
                    <td style="vertical-align: middle;">
                        {{ acquisition.signed_contract == 1 ? "Yes" : "No" }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ acquisition.manner_of_acquisition.acquisition_name}}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ acquisition.initial_hc_acquired }}
                    </td>

                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(acquisition)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(acquisition)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="client_acquisitions" :object="acquisitions" 
                :url="`api/clients/${this.client_id}/acquisitions?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`"
                :query="`keyword=${this.query.search_keyword}&order_by=${this
                .query.order_by}&per_page=${this.query
                .per_page}&sort_column=${this.query.sort_column}`"
                classSize="pagination-sm">
        </pagination>
    </div>
</template>

<script>
    import Pagination from '../../pagination/Pagination';

    export default {
        created() {
            this.loadClientAcquisitionsRecord();
        },
        computed: {
            client_id() {
                return this.$route.params.clientId;
            },
            acquisitions() {
                return this.$store.getters.getClientAcquisitions;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            },
            query() {
                return this.$store.getters.getUserApiQuery;
            },
            columns() {
                return this.$store.getters.getColumns;
            },
            page_display() {
                return this.$store.getters.getPageDisplay;
            }
        },
        methods: {
            edit(acquisition) {
                let payload = {
                    client_id: this.$route.params.clientId,
                    acquisition_id: acquisition.id
                }
                this.$store.dispatch('loadClientAcquisition', payload);
                this.$store.dispatch('setModalTitle', 'Acquisition Details');
                this.$store.dispatch('setModalFormType', 'EDIT_CLIENT_ACQUISITION_RECORD');
                $("#createUserModal").modal("show")
            },
            destroy(acquisition) {
                let deletionType = {
                    scope: "client_acquisitions",
                    client_acquisition: acquisition
                };

                this.$store.dispatch('setModalTitle', "Delete Acquisition record ?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            },
            loadClientAcquisitionsRecord() {
                return this.$store.dispatch('loadClientAcquisitions', `api/clients/${this.client_id}/acquisitions?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`)
            },
        },
        components: {
            Pagination
        }
    }
</script>

<style scoped>
    table.calls-table td{
        font-size: 12px;
    }
</style>
