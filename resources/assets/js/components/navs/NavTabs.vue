<template>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#definition" role="tab"><strong> <span class="fa fa-tachometer"></span> DASHBOARD</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#home" role="tab"> <strong> <span class="fa fa-users"></span> CLIENTS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reports" role="tab"><strong> <span class="fa fa-bar-chart"></span> REPORTS</strong></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="definition" role="tabpanel" aria-labelledby="profile-tab">
                <div class="wrapper mt-2">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mt-2 text-center"><i class="ion ion-clipboard"></i> LIST OF PENDING TASKS</h5>
                                    <hr>
                                    <div class="card card-default rounded-0">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0 lead">PENDING TASK</h5>
                                        </div>
                                        <div class="card-body p-2">
                                            <pending-tasks-table></pending-tasks-table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                           
                            
                            <div class="col-sm-12  clearfix">
                                <h5 class="mt-1 mb-0 float-left"><i class="fa fa-line-chart"></i> GOAL STATS</h5>
                                <div class="form-inline justify-content-end">
                                    <div class="form-group">
                                        <!-- <label for="info-card" class="mr-1">Select Month/Year: </label> -->
                                        <select v-model="month" name="" id="info-card" class="form-control form-control-sm mr-1">
                                            <option v-for="(month, i) in  months" :key="i" :value="month.id">{{ month.name }}</option>
                                        </select>
                                        <select v-model="year" name="" id="info-card" class="form-control form-control-sm mr-1">
                                            <option v-for="(year, i) in  years" :key="i" :value="year.target_year">{{ year.target_year }}</option>
                                        </select>
                                        <button @click="reloadInfoCardData" class="btn btn-success btn-sm">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <info-card icon="fa fa-users" :isLoading="potentialClientsIsLoading" :title="'Potential Clients'" :currentValue="potential_clients.clients_count" :targetValue="potential_clients.target_increase_potential_client"></info-card>
                            <info-card icon="fa fa-volume-control-phone" :isLoading="noOfCallsMadeIsLoading" :title="'No. of Calls Made'" :currentValue="no_of_calls_made.calls_count" :targetValue="no_of_calls_made.target_no_of_calls_made"></info-card>
                            <info-card icon="fa fa-envelope-o" :isLoading="proposalsToBeSentIsLoading" :title="'Proposals to be Sent'" :currentValue="proposals_tobe_sent.proposal_sent_saturations" :targetValue="proposals_tobe_sent.target_proposal_tobe_sent"></info-card>
                            <info-card icon="fa fa-laptop" :isLoading="noOfFormalPresentationsIsLoading" :title="'No. of Formal Presentations'" :currentValue="no_of_formal_presentations.no_of_actual_presentations" :targetValue="no_of_formal_presentations.target_no_formal_presentation"></info-card>
                            <info-card icon="fa fa-handshake" :isLoading="acquiredClientsIsLoading" :title="'No. of Clients Acquired'" :currentValue="acquired_clients.no_of_acquired_clients" :targetValue="acquired_clients.target_client_tobe_acquired"></info-card>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <clients-table></clients-table>
            </div>
            <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                <report></report>
            </div>
        </div>
        
        <confirmation-modal>
            <div slot="confirmationHeader" v-html="modalTitle"></div>
        </confirmation-modal>
    </div>
</template>

<script>
    import clientsTable from '../tables/clientsTable.vue';
    import Modal from '../modal/modal';
    import ConfirmationModal from '../modal/ConfirmationModal';
    import Report from '../reports/report';
    import InfoCard from '../dashboard/InfoCard';
    import ClientsChart from '../../charts/clientsChart'; 
    import PendingTasksTable from '../tables/dashboard/PendingTasksTable';
    // import ToCallsTable from '../tables/dashboard/ToCallsTable';
    // import ToSendProposalTable from '../tables/dashboard/ToSendProposalTable';
    // import ToRequestPresentationTable from '../tables/dashboard/ToRequestPresentationTable';

    export default {
        data(){
            return {
                year: null,
                date: new Date,
                month: new Date().getMonth() + 1,
                datacollection:  null,
                options: {
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                        gridLines: {
                            display: true
                        }
                        }],
                        xAxes: [ {
                            gridLines: {
                                display: true
                            },
                            ticks: {
                                autoSkip: false
                            }
                        }]
                    },
                    legend: {
                        display: true
                    },
                    responsive: true,
                    maintainAspectRatio: true
                    }
            }
        },
        computed: {
            potential_clients() {
                return this.$store.getters.getPotentialClients;
            },
            potentialClientsIsLoading() {
                return this.$store.getters.getPotentialClientsLoadingState;
            },
            no_of_calls_made() {
                return this.$store.getters.getNoOfCallsMade;
            },
            noOfCallsMadeIsLoading() {
                return this.$store.getters.getNoOfCallsMadeLoadingState;
            },
            proposals_tobe_sent() {
                return this.$store.getters.getProposalsToBeSent;
            },
            proposalsToBeSentIsLoading() {
                return this.$store.getters.getProposalsToBeSentLoadingState;
            },
            no_of_formal_presentations() {
                return this.$store.getters.getNoOfFormalPresentations;
            },
            noOfFormalPresentationsIsLoading() {
                return this.$store.getters.getNoOfFormalPresentationsLoadingState;
            },
            acquired_clients() {
                return this.$store.getters.getAcquiredClients;
            },  
            acquiredClientsIsLoading() {
                return this.$store.getters.getAcquiredClientsLoadingState;
            },
            months() {
                return this.$store.getters.getReportMonths;
            },
            years() {
                return this.$store.getters.getTargetListYears;
            },
            isLoading(){
                return this.$store.getters.getLoadingState;
            },
            modalTitle(){
                return this.$store.getters.getModalTitle;
            },
            authUser() {
                return this.$auth.getter();
            }
        },
        watch: {
            years: function() {
            
                let latest = null;
                let temp = null;
                
                this.years.forEach(element => {
                    temp = element.target_year;
                    latest = element.target_year > latest ? element.target_year : latest;
                });

                this.year = latest;
                this.reloadInfoCardData();
            },
        },
        methods: {
            reloadInfoCardData() {
                this.$store.dispatch('loadPotentialClients', `api/kpi/potential-clients/month/${this.month}/year/${this.year}`);
                this.$store.dispatch('loadNoOfCallsMade', `api/kpi/no-of-calls-made/month/${this.month}/year/${this.year}`);
                this.$store.dispatch('loadProposalsToBeSent', `api/kpi/proposals-to-be-sent/month/${this.month}/year/${this.year}`);
                this.$store.dispatch('loadNoOfFormalPresentations', `api/kpi/no-of-formal-presentations/month/${this.month}/year/${this.year}`);
                this.$store.dispatch('loadAcquiredClients', `api/kpi/no-of-acquired-clients/month/${this.month}/year/${this.year}`);
            },
            // generateRandomData(){
            //     return Math.floor(Math.random() * 120);
            // },
            // fillDataCollection() {
            //     this.datacollection = {
            //         labels: this.months,
            //         datasets: [
            //             {
            //                 label: '# of Clients',
            //                 backgroundColor: "#3e95cd",
            //                 data: [ 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(),
            //                      this.generateRandomData(), 
            //                      this.generateRandomData()
            //                 ],
            //             },
            //             {
            //                 label: '# of Calls Made',
            //                 backgroundColor: "#8e5ea2",
            //                 data: [ 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(),
            //                      this.generateRandomData(), 
            //                      this.generateRandomData()
            //                 ],
            //             },
            //             {
            //                 label: '# of Saturations',
            //                 backgroundColor:"#3cba9f",
            //                 data: [ 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(),
            //                      this.generateRandomData(), 
            //                      this.generateRandomData()
            //                 ],
            //             },
            //             {
            //                 label: '# of Presentations',
            //                 backgroundColor: "#e8c3b9",
            //                 data: [ 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(), 
            //                     this.generateRandomData(),
            //                     this.generateRandomData(), 
            //                     this.generateRandomData()
            //                 ],
            //             }
            //         ]
            //     };
            // },
        },
        components:{
            clientsTable,
            Report,
            ConfirmationModal,
            InfoCard,
            ClientsChart,
            PendingTasksTable
            // ToCallsTable,
            // ToSendProposalTable,
            // ToRequestPresentationTable
        },
        beforeDestroy(){
            this.datacollection = null;
            console.log(this.datacollection)
          
        },
        created() {
            Echo.private("client-channel").listen("ClientSubrecordEvent", e => {
               this.reloadInfoCardData();
            });
        },
        destroyed() {
            Echo.leave('client-channel');
        }
    }
</script>
<style scoped>
    a {
        color: #495057; 
    }
</style>
