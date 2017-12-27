<template>
    <div>
        <table class="table table-borderless table-striped m-b-none saturation-table">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Proposal By</th>
                    <th>Date of Saturation</th>
                    <th>Mode of Saturation</th>
                    <th>Call Slip</th>
                    <th>Proposal Received & Accepted</th>
                    <th>Manner of Confirmation</th>
                    <th>Client Response</th>
                    <th>FF-calls made</th>
                    <th>Date of Last FF-up</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-if="isLoading">
                    <td colspan="11" class="text-center">
                    <div v-if="isLoading" class="card-body">
                            <div class="img-loading-container">
                                <img src="/images/spinner.gif" class="img-sm">
                            </div>   
                        </div>
                    </td>
                </tr> -->

                <tr v-if="saturations.data == 0">
                    <td colspan="11" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(saturation, index) in saturations.data" :key="index">
                   <!-- <td style="vertical-align: middle;">
                        {{ call.id }}
                    </td> -->
                    <td style="vertical-align: middle;">
                        {{ saturation.user.initial }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ saturation.saturation_date | humanReadableFormat }}
                    </td>
                    
                    <td style="vertical-align: middle;">
                        {{ saturation.saturation_mode }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ saturation.call_slip }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ saturation.proposal_accepted == 1 ? 'Yes' : 'No' }}
                    </td>
                   
                    <td style="vertical-align: middle;">
                        {{ saturation.manner_of_confirmation }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ saturation.client_response}}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ saturation.ff_calls_made == 1 ? 'Yes' : 'No' }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ saturation.last_ffup_date | humanReadableFormat }}
                    </td>

                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(saturation)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(saturation)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="client_saturations" :object="client_saturations" 
                :url="`api/clients/${this.client_id}/saturations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`"
                :query="`keyword=${this.query.search_keyword}&order_by=${this
                .query.order_by}&per_page=${this.query
                .per_page}&sort_column=${this.query.sort_column}`"
                classSize="pagination-sm">
        </pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        created() {
            this.loadClientSaturationRecord();
        },
        computed: {
            client_id() {
                return this.$route.params.clientId;
            },
            saturations() {
                return this.$store.getters.getClientSaturations;
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
            edit(saturation) {
                let payload = {
                    client_id: this.$route.params.clientId,
                    saturation_id: saturation.id
                }
                this.$store.dispatch('loadClientSaturation', payload);
                this.$store.dispatch('setModalTitle', 'Saturation Details');
                this.$store.dispatch('setModalFormType', 'EDIT_SATURATION_RECORD');
                $("#createUserModal").modal("show")
            },
            destroy(saturation) {
                let deletionType = {
                    scope: "client_saturations",
                    client_saturation: saturation
                };

                this.$store.dispatch('setModalTitle', "Delete " + saturation.saturation_mode + " ?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            },
            loadClientSaturationRecord() {
                return this.$store.dispatch('loadClientSaturations', `api/clients/${this.client_id}/saturations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`)
            },
        },
        components: {
            Pagination
        }
    }
</script>

<style scoped>
    table.saturation-table th{
        font-size: 11px;
    }
</style>
