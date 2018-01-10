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
        <modal></modal>
    </div>
</template>

<script>
import NavTabs from "../navs/NavTabs.vue";
import modal from '../modal/modal.vue';
import NavButtons from '../nav-buttons/NavButtons';
import {store} from '../../store/store';

export default {
    created() {
        /**@argument
         * Load/Dispatch loadClients action from store data on page load
         * this.$store.dispatch('loadClients');
         */
        Echo.private('client-channel')
        .listenForWhisper('creating', (e) => {
            toastr.info('', e.user + ' ' + e.message)
            console.log(e)
        })
    },
    beforeRouteEnter(to, from, next) {
        store.dispatch('clearIndustries');
        store.dispatch('clearStatuses');
        store.dispatch("loadIndustries", "api/maintainance/industries?type=all");
        store.dispatch('loadStatuses','api/maintainance/statuses?type=all');
        next();
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
    },
    methods: {

    },
    components: {
        NavTabs,
        modal,
        NavButtons
    }
}
</script>

<style scoped>

</style>

