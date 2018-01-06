<template>
    <div>
        <table class="table table-borderless table-striped m-b-none calls-table">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Presentor</th>
                    <th>Mode of Presentation</th>
                    <th>Date of Presented</th>
                    <th>Call Slip</th>
                    <th>Status</th>
                    <th>Response</th>
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

                <tr v-if="presentations.data == 0">
                    <td colspan="11" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(presentation, index) in presentations.data" :key="index">
                   <!-- <td style="vertical-align: middle;">
                        {{ presentation.id }}
                    </td> -->
                    <td style="vertical-align: middle;">
                        {{ presentation.user.initial }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ presentation.date_of_call | humanReadableFormat }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ presentation.confirmation_preCall == 1 ? 'Yes' : 'No' }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ presentation.productive_call == 1 ? 'Yes' : 'No' }}
                    </td>
                   
                    <td style="vertical-align: middle;">
                        {{ presentation.proposal_sent == 1 ? 'Yes' : 'No' }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ presentation.client_response}}
                    </td>

                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(presentation)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(presentation)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="presentations" :object="presentations" 
                :url="`api/clients/${this.client_id}/presentations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`"
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
            this.loadClientPresentationsRecord();
        },
        computed: {
            client_id() {
                return this.$route.params.clientId;
            },
            presentations() {
                return this.$store.getters.getClientPresentations;
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
            edit(presentation) {
                let payload = {
                    client_id: this.$route.params.clientId,
                    presentation_id: presentation.id
                }
                this.$store.dispatch('loadClientPresentation', payload);
                this.$store.dispatch('setModalTitle', 'Presentation Details');
                this.$store.dispatch('setModalFormType', 'EDIT_PRESENTATION_RECORD');
                $("#createUserModal").modal("show")
            },
            destroy(presentation) {
                let deletionType = {
                    scope: "client_presentations",
                    client_presentation: presentation
                };

                this.$store.dispatch('setModalTitle', "Delete Presentation record ?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            },
            loadClientPresentationsRecord() {
                return this.$store.dispatch('loadClientPresentations', `api/clients/${this.client_id}/presentations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`)
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
