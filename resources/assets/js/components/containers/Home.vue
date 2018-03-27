<template>
    <div class="row  justify-content-center">
        <div class="col-md-12">
            <nav-buttons></nav-buttons>
            <div class="card card-default rounded-0">
                <div class="card-body home-tab p-2">
                    <nav-tabs></nav-tabs>
                    <!-- <clients-table></clients-table> -->
                </div>
            </div>
        </div>
        <modal>
            <template slot="header"> {{ modalTitle }}</template>

            <div v-if="modalFormType == 'SHOW_CALLS_TABLE'">
                <client-calls-table 
                    :clientId="client_id" 
                    :displayOptions="false">
                </client-calls-table>
            </div>
            
            <div v-if="modalFormType == 'SHOW_SATURATIONS_TABLE'">
                <client-saturations-table 
                    :clientId="client_id"
                    :displayOptions="false">
                </client-saturations-table>
            </div>

            <div v-if="modalFormType == 'SHOW_PRESENTATIONS_TABLE'">
                <client-presentations-table 
                    :clientId="client_id"
                    :displayOptions="false">
                </client-presentations-table>
            </div>

            <div v-if="modalFormType == 'SHOW_CONTACT_PERSONS_TABLE'">
                <contact-persons-table 
                    :clientId="client_id"
                    :displayOptions="false"></contact-persons-table>
            </div>

            <div 
                v-if="((modalFormType == 'SHOW_CALL_TASKS_SEVEN_DAYS') 
                        || (modalFormType =='SHOW_CALL_TASKS_ONE_MONTH') 
                        ||( modalFormType =='SHOW_CALL_TASKS_THREE_MONTHS') 
                        || (modalFormType =='SHOW_CALL_TASKS_SIX_MONTHS') 
                        || (modalFormType =='SHOW_CALL_TASKS_ONE_YEAR')
                        ||(modalFormType == 'SHOW_SATURATION_TASKS_SEVEN_DAYS')
                        || (modalFormType =='SHOW_SATURATION_TASKS_ONE_MONTH') 
                        ||( modalFormType =='SHOW_SATURATION_TASKS_THREE_MONTHS') 
                        || (modalFormType =='SHOW_SATURATION_TASKS_SIX_MONTHS') 
                        || (modalFormType =='SHOW_SATURATION_TASKS_ONE_YEAR')
                        ||(modalFormType == 'SHOW_PRESENTATION_TASKS_SEVEN_DAYS')
                        || (modalFormType =='SHOW_PRESENTATION_TASKS_ONE_MONTH') 
                        ||( modalFormType =='SHOW_PRESENTATION_TASKS_THREE_MONTHS') 
                        || (modalFormType =='SHOW_PRESENTATION_TASKS_SIX_MONTHS') 
                        || (modalFormType =='SHOW_PRESENTATION_TASKS_ONE_YEAR')
                        ||(modalFormType == 'SHOW_NEGOTIATION_TASKS_SEVEN_DAYS')
                        || (modalFormType =='SHOW_NEGOTIATION_TASKS_ONE_MONTH') 
                        ||( modalFormType =='SHOW_NEGOTIATION_TASKS_THREE_MONTHS') 
                        || (modalFormType =='SHOW_NEGOTIATION_TASKS_SIX_MONTHS') 
                        || (modalFormType =='SHOW_NEGOTIATION_TASKS_ONE_YEAR')
                        )">
                <dynamic-table></dynamic-table>
            </div>
        </modal>
    </div>
</template>

<script>
import NavTabs from "../navs/NavTabs.vue";
import Modal from '../modal/TableModal';
import NavButtons from '../nav-buttons/NavButtons';
import {store} from '../../store/store';
import ClientCallsTable from '../tables/ClientCallsTable';
import ClientSaturationsTable from '../tables/ClientSaturationsTable';
import ClientPresentationsTable from '../tables/ClientPresentationsTable';
import ContactPersonsTable from '../tables/client/ContactPersonsTable';
import DynamicTable from '../tables/dashboard/DynamicTable';

export default {
    beforeRouteEnter(to, from, next) {
        store.dispatch('clearIndustries');
        store.dispatch('clearStatuses');
        store.dispatch("loadIndustries", "api/maintenance/industries?type=all");
        store.dispatch('loadStatuses','api/maintenance/statuses?type=all');
        store.dispatch('loadReportMonths','api/reports/report-months');
        store.dispatch('loadTargetListYears');
        next();
    },
    created() {
       
    },
    data() {
        return {

        }
    },
    computed: {
        /**@argument
         * Get clients from store getters
         * clients(){
         *      return this.$store.getters.loadClients;
         * }
         */
        modalTitle() {
            return this.$store.getters.getModalTitle;
        },
        modalFormType() {
            return this.$store.getters.getModalFormType;
        },
        client_id() {
            return this.$store.getters.getModalParams;
        },
    },
    methods: {

    },
    components: {
        NavTabs,
        Modal,
        NavButtons,
        ClientCallsTable,
        ClientSaturationsTable,
        ClientPresentationsTable,
        ContactPersonsTable,
        DynamicTable
    }
}
</script>

<style scoped>

</style>

