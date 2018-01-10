<template>
    <div class="row  justify-content-center">
        <div class="col-md-8" data-spy="scroll" data-target="#spy-form" data-offset="0">
            <alert-reminder></alert-reminder>
            <nav-buttons></nav-buttons>
            <!-- Client Details -->
            <client-details-form></client-details-form>
        </div>
    </div>
</template>

<script>
    import ClientDetailsForm from "../forms/client/ClientDetailsForm";
    import NavButtons from '../nav-buttons/NavButtons';
    import AlertReminder from '../alerts/AlertReminder';
    import {store} from '../../store/store.js';
    
    export default {
        mounted() {
           
        },
        beforeRouteEnter(to, from, next) {
            store.dispatch('clearNationalities');
            store.dispatch('clearIndustries');
            store.dispatch('clearIsoCertificates');
            store.dispatch('clearSourcingPractices');
            store.dispatch('clearDepartments');
            store.dispatch('clearPositions');
            store.dispatch('clearManpowers');
            store.dispatch('clearUserTypes');
            store.dispatch('clearCompanies');
            store.dispatch('clearClient');
            store.dispatch('clearStatuses');
            store.dispatch('loadNationalities','api/maintainance/nationalities?type=all');
            store.dispatch('loadCertificates','api/maintainance/certificates?type=all');
            store.dispatch('loadIndustries','api/maintainance/industries?type=all');
            store.dispatch('loadSourcingPractices','api/maintainance/sourcing_practices?type=all');
            store.dispatch('loadDepartments','api/maintainance/departments?type=all');
            store.dispatch('loadPositions', 'api/maintainance/positions?type=all');
            store.dispatch('loadManpowers', 'api/maintainance/manpowers?type=all');
            store.dispatch('loadCompanies', 'api/companies?type=all');
            store.dispatch('loadStatuses','api/maintainance/statuses?type=all');
            if(Object.keys(to.params).length != 0 && to.params.clientId != null) {
                let payload = {
                    id: to.params.clientId
                };
                localStorage.setItem('f_type', 'EDIT_CLIENT');
                store.dispatch('loadClient', payload);
            }
            else{
                localStorage.setItem('f_type', 'CREATE_CLIENT');
            }
            next();
        },
        computed: {},
        components: {
            ClientDetailsForm,
            // ClientCallsForm,
            // ClientSaturationForm,
            // ClientPresentationForm,
            // ClientAcquisitionForm,
            NavButtons,
            AlertReminder
        }
    };
</script>

<style scoped>
    a:hover {
        text-decoration: none;
    }
</style>