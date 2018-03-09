<template>
    <div id="deleteConfirmationModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0" style="font-size:16px;">
                        <slot name="confirmationHeader"></slot>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="clearfix">
                        <div class="form-group float-left">
                            <button @click="submitConfirmation" class="btn btn-sm btn-success" style="width:60px;">Yes</button>
                        </div>
                        <div class="form-group float-right">
                            <button @click="closeConfirmationModal" class="btn btn-sm btn-danger" style="width:60px;">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        created(){
            // console.log(this.deletionType)
        },
        computed:{
            deletionType () {
                return this.$store.getters.getDeletionType;
            },
            query() {
                return this.$store.getters.getUserApiQuery;
            },
            client_query() {
                return this.$store.getters.getClientApiQuery;
            },
            columns() {
                return this.$store.getters.getColumns;
            },
            page_display() {
                return this.$store.getters.getPageDisplay;
            },

        },
        methods:{
            submitConfirmation () {
                var deletionInfo = this.deletionType;
                switch (deletionInfo.scope) {
                    case "clients":
                        this.$store.dispatch('deleteClient', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch(
                                "loadClients",
                                `api/clients?keyword=${this.client_query.search_keyword}&order_by=${this.client_query.order_by}&per_page=${this.client_query.per_page}&sort_column=${this.client_query.sort_column}&industry=${this.client_query.industry}&location=${this.client_query.location}&from_date=${this.client_query.from_date}&to_date=${this.client_query.to_date}&status=${this.client_query.status}`
                            );
                        });
                    break;
                    case "users":
                        this.$store.dispatch('deleteUser', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadUsers', `api/users?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                        });
                        break;
                    case "industries":
                        this.$store.dispatch('deleteIndustry', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadIndustries','api/maintenance/industries');
                        });
                        break;
                    case "nationalities":
                        this.$store.dispatch('deleteNationality', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadNationalities','api/maintenance/nationalities');
                        });
                        break;
                    case "certificates":
                        this.$store.dispatch('deleteCertificate', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadCertificates','api/maintenance/certificates');
                        });
                    case "departments":
                        this.$store.dispatch('deleteDepartment', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadDepartments','api/maintenance/departments');
                        });
                        break;
                    case "positions":
                        this.$store.dispatch('deletePosition', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadPositions','api/maintenance/positions');
                        });
                        break;
                    case "manpowers":
                        this.$store.dispatch('deleteManpower', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadManpowers','api/maintenance/manpowers');
                        });
                        break;
                    case "user_types":
                        this.$store.dispatch('deleteUserType', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadUserTypes','api/user_types');
                        });
                    case "companies":
                        this.$store.dispatch('deleteCompany', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadCompanies','api/companies');
                        });
                        break;
                    case "client_saturations":
                        this.$store.dispatch('deleteClientSaturation', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadClientSaturations', `api/clients/${deletionInfo.client_saturation.client_id}/saturations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                        });
                        break;
                    case "client_calls":
                        this.$store.dispatch('deleteClientCall', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadClientCalls', `api/clients/${deletionInfo.client_call.client_id}/calls?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                        });
                        break;
                    case "client_presentations":
                        this.$store.dispatch('deleteClientPresentation', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadClientPresentations', `api/clients/${deletionInfo.client_presentation.client_id}/presentations?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                        });
                        break;
                    case "client_acquisitions":
                        this.$store.dispatch('deleteClientAcquisition', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadClientAcquisitions', `api/clients/${deletionInfo.client_acquisition.client_id}/acquisitions?keyword=${this.query.search_keyword}&order_by=${this.query.order_by}&per_page=${this.query.per_page}&sort_column=${this.query.sort_column}`);
                        });
                        break;
                    case "saturations":
                        this.$store.dispatch('deleteSaturation', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadSaturations','api/maintenance/saturations');
                        });
                        break;
                    case "confirmations":
                        this.$store.dispatch('deleteConfirmation', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadConfirmations','api/maintenance/confirmations');
                        });
                        break;
                    case "action_plans":
                        this.$store.dispatch('deleteConfirmation', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadActionPlans','api/maintenance/action-plans');
                        });
                        break;
                    case "mode_of_presentations":
                        this.$store.dispatch('deleteConfirmation', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadModeOfPresentations','api/maintenance/mode-of-presentations');
                        });
                        break;
                    case "presentation_statuses":
                        this.$store.dispatch('deleteConfirmation', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadPresentationStatuses','api/maintenance/presentation-statuses');
                        });
                        break;
                    case "acquisitions":
                        this.$store.dispatch('deleteAcquisition', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadAcquisitions','api/maintenance/acquisitions');
                        });
                        break;
                    case "target_lists":
                        this.$store.dispatch('deleteAcquisition', deletionInfo)
                        .then(() => {
                            this.$store.dispatch('closeConfirmationModal');
                        })
                        .then(() => {
                            this.$store.dispatch('loadTargetLists','api/reports/target-lists');
                        });
                        break;
                    default:
                        break;
                }

                
            },
            closeConfirmationModal () {
                this.$store.dispatch('closeConfirmationModal');
            }
        }
    };
</script>
