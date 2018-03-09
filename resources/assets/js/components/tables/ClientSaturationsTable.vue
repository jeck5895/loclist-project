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
                    <th>Company</th>
                    <th>Client Response</th>
                    <th>FF-calls made</th>
                    <th>Date of Last FF-up</th>
                    <th v-if="displayOptions && (user.user_role.edit_client_saturations == 1 || user.user_role.delete_client_saturations == 1)">Options</th>
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

                <tr v-if="client_saturations.data == 0">
                    <td colspan="11" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(client_saturation, index) in client_saturations.data" :key="index">
                   <!-- <td style="vertical-align: middle;">
                        {{ call.id }}
                    </td> -->
                    <td style="vertical-align: middle;">
                        {{ client_saturation.user.initial }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client_saturation.saturation_date | humanReadableFormat }}
                    </td>
                    
                    <td style="vertical-align: middle;">
                        {{ client_saturation.saturation.saturation_mode }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client_saturation.call_slip }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client_saturation.proposal_accepted == 1 ? 'Yes' : 'No' }}
                    </td>
                   
                    <td style="vertical-align: middle;">
                        {{ client_saturation.confirmation.confirmation_name }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client_saturation.company.code }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client_saturation.client_response1}}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client_saturation.ff_calls_made == 1 ? 'Yes' : 'No' }}
                    </td>

                    <td v-if="client_saturation.last_ffup_date != null" style="vertical-align: middle;">
                        {{ client_saturation.last_ffup_date | humanReadableFormat }}
                    </td>

                    <td v-else style="vertical-align: middle;">
                        N/A
                    </td>

                    <td v-if="displayOptions && (user.user_role.edit_client_saturations == 1 || user.user_role.delete_client_saturations == 1)" style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button v-if="user.user_role.edit_client_saturations == 1" type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(client_saturation)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button v-if="user.user_role.delete_client_saturations == 1" @click="destroy(client_saturation)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="client_saturations" :object="client_saturations" 
                :url="`api/clients/${this.clientId}/saturations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`"
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
        props:['clientId','displayOptions'],
        data() {
            return {
                user: Vue.auth.getter()
            }
        },
        computed: {
            // client_id() {
            //     return this.$route.params.clientId;
            // },
            client_saturations() {
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
         created() {
            this.loadClientSaturationRecord();
            Echo.private(`client-saturation-channel-${this.clientId}`).listen("ClientSaturationEvent", e => {
                console.log(e);
                this.loadClientSaturationRecord();
                toastr.info('', e.message.response);
            });
        },
        methods: {
            edit(client_saturation) {
                let payload = {
                    client_id: this.clientId,//this.$route.params.clientId,
                    saturation_id: client_saturation.id
                }
                this.$store.dispatch('loadClientSaturation', payload);
                this.$store.dispatch('setModalTitle', 'Saturation Details');
                this.$store.dispatch('setModalFormType', 'EDIT_CLIENT_SATURATION_RECORD');
                $("#createUserModal").modal("show")
            },
            destroy(client_saturation) {
                let deletionType = {
                    scope: "client_saturations",
                    client_saturation: client_saturation
                };

                this.$store.dispatch('setModalTitle', "Delete saturation record?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            },
            loadClientSaturationRecord() {
                return this.$store.dispatch('loadClientSaturations', `api/clients/${this.clientId}/saturations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`)
            },
        },
        destroyed() {
            Echo.leave(`client-saturation-channel-${this.clientId}`);
        },
        components: {
            Pagination
        }
    }
</script>

<style scoped>
    table.saturation-table th, td{
        font-size: 11px;
    }
</style>
