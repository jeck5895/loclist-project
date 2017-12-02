<template>
    <div class="row  justify-content-center">
        <div class="col-md-12">
            <!-- <div class="flex-row mb-1">
                <div class="card card-default rounded-0">
                    <div class="card-body p-2">

                    </div>
                </div>
            </div> -->
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

export default {
    created() {
        /**@argument
         * Load/Dispatch loadClients action from store data on page load
         * this.$store.dispatch('loadClients');
         */
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
        modal
    }
}
</script>

<style scoped>

</style>

