<template>
    <div>
        <table class="table table-borderless table-striped m-b-none calls-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Caller</th>
                    <th class="tbl-header-date">Date of Call</th>
                    <th style="width:140px">Confirmation Pre-call</th>
                    <th class="tbl-header-date">Productive</th>
                    <th style="width:110px">Proposal Sent</th>
                    <th>Company</th>
                    <th>Response</th>
                    <th v-if="displayOptions">Options</th>
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

                <tr v-if="calls.data == 0">
                    <td colspan="11" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(call, index) in calls.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ call.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ call.user.initial }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ call.date_of_call | humanReadableFormat }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ call.confirmation_preCall == 1 ? 'Yes' : 'No' }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ call.productive_call == 1 ? 'Yes' : 'No' }}
                    </td>
                   
                    <td style="vertical-align: middle;">
                        {{ call.proposal_sent == 1 ? 'Yes' : 'No' }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ call.company.code }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ call.client_response}}
                    </td>

                    <td v-if="displayOptions" style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(call)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(call)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="calls" :object="calls" 
                :url="`api/clients/${this.clientId}/calls?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`"
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
                //client_id: this.$route.params.clientId,
            }
        },
        computed: {
            // client_id() {
            //     return this.$route.params.clientId;
            // },
            calls() {
                return this.$store.getters.getClientCalls;
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
            this.loadClientCallsRecord();
            console.log(this.clientId + " created")
            /**
             * Listen for call record update 
             */
            Echo.private(`client-call-channel-${this.clientId}`).listen("ClientCallEvent", e => {
                console.log(e);
                //if(e.message.client.id == this.clientId){
                    this.loadClientCallsRecord();
                    toastr.info('', e.message.response);
                //}
            });
        },
        methods: {
            edit(call) {
                let payload = {
                    client_id: this.clientId,//this.$route.params.clientId,
                    call_id: call.id
                }
                this.$store.dispatch('loadClientCall', payload);
                this.$store.dispatch('setModalTitle', 'Call Details');
                this.$store.dispatch('setModalFormType', 'EDIT_CALL_RECORD');
                $("#createUserModal").modal("show")
            },
            destroy(call) {
                let deletionType = {
                    scope: "client_calls",
                    client_call: call
                };

                this.$store.dispatch('setModalTitle', "Delete Call record ?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            },
            loadClientCallsRecord() {
                return this.$store.dispatch('loadClientCalls', `api/clients/${this.clientId}/calls?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`)
            },
        },
        watch:{
            clientId: 'loadClientCallsRecord',
        },
        destroyed() {
            console.log(this.clientId + " destroyed")
            Echo.leave(`client-call-channel-${this.clientId}`);
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
    .tbl-header-date{
        width: 80px;
    }
</style>
