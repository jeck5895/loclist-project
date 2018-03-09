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
                                    <div class="card rounded-0">
                                        <div class="card-header clearfix bg-white">
                                            <h5 class="float-left"><i class="fa fa-line-chart"></i> KPI CHART ANALYSIS</h5> 
                                            <div class="col-sm-4 float-right">
                                                <select name="" id="" class="form-control form-control-sm">
                                                    <option v-for="(year, i) in  years" :key="i" :value="year.target_year">{{ year.target_year }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <clients-chart v-if="!isLoading" :chart-data="datacollection" :options="options" :height="200"></clients-chart>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <info-cards></info-cards>
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
    import InfoCards from '../dashboard/InfoCards';
    import ClientsChart from '../../charts/clientsChart'; 
    // import ClientsFilter from '../filters/ClientsFilter';

    export default {
        created() {
            // console.log(this.modalFormType)
            this.fillDataCollection();
        },
        data(){
            return {
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
        computed:{
            months() {
                return this.$store.getters.getReportMonthNames;
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
        
        methods: {
            generateRandomData(){
                return Math.floor(Math.random() * 120);
            },
            fillDataCollection() {
                this.datacollection = {
                    labels: this.months,
                    datasets: [
                        {
                            label: '# of Clients',
                            backgroundColor: "#3e95cd",
                            data: [ 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(),
                                 this.generateRandomData(), 
                                 this.generateRandomData()
                            ],
                        },
                        {
                            label: '# of Calls Made',
                            backgroundColor: "#8e5ea2",
                            data: [ 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(),
                                 this.generateRandomData(), 
                                 this.generateRandomData()
                            ],
                        },
                        {
                            label: '# of Saturations',
                            backgroundColor:"#3cba9f",
                            data: [ 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(),
                                 this.generateRandomData(), 
                                 this.generateRandomData()
                            ],
                        },
                        {
                            label: '# of Presentations',
                            backgroundColor: "#e8c3b9",
                            data: [ 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(), 
                                this.generateRandomData(),
                                this.generateRandomData(), 
                                this.generateRandomData()
                            ],
                        }
                    ]
                };
            },
        },
        components:{
            clientsTable,
            Report,
            ConfirmationModal,
            InfoCards,
            ClientsChart,
        },
        beforeDestroy(){
            this.datacollection = null;
            console.log(this.datacollection)
          
        }
    }
</script>
<style scoped>
    a {
        color: #495057; 
    }
</style>
