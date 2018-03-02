<template>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home" role="tab"> <strong> <span class="fa fa-users"></span> CLIENTS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#definition" role="tab"><strong> <span class="fa fa-book"></span> DEFINITION OF TERMS</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reports" role="tab"><strong> <span class="fa fa-bar-chart"></span> REPORTS</strong></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <clients-table></clients-table>
            </div>
            <div class="tab-pane fade" id="definition" role="tabpanel" aria-labelledby="profile-tab">
                This is Definition of Terms Tab
            </div>
            <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                <report></report>
            </div>
        </div>
        
        <confirmation-modal>
            <template slot="confirmationHeader"> {{ modalTitle }} </template>
        </confirmation-modal>
    </div>
</template>

<script>
    import clientsTable from '../tables/clientsTable.vue';
    import Modal from '../modal/modal';
    import ConfirmationModal from '../modal/ConfirmationModal';
    import Report from '../reports/report';
    // import ClientsFilter from '../filters/ClientsFilter';

    export default {
        mounted() {
            // console.log(this.modalFormType)
        },
        data(){
            return {
                
            }
        },
        computed:{
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
        components:{
            clientsTable,
            Report,
            ConfirmationModal,
        },
        filters:{
            
        }
    }
</script>
<style scoped>
    a {
        color: #495057; 
    }
</style>
