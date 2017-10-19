<template>
    <div class="row  justify-content-center">
        <div class="col-md-12">
            <div class="flex-row mb-1">
                <div class="card card-default rounded-0">
                    <div class="card-body p-2">
                        
                        <form class="form-inline">
                                <div class="form-group">
                                    <label for="dateFrom" class="mr-sm-1">Entry Date</label>
                                    <input type="date" class="dmw form-control form-control-sm mr-sm-2" name="" id="dateFrom">
                                </div>
                                <div class="form-group">
                                    <label for="dateTo" class="mr-sm-1">to</label>
                                    <input type="date" class="dmw form-control form-control-sm mr-sm-2" name="" id="dateTo">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mr-sm-1">Location:</label>
                                    <select class="form-control form-control-sm mr-sm-2" id="exampleFormControlSelect1">
                                        <option>Metro Manila</option>
                                        <option>Abra</option>
                                        <option>Bulacan</option>
                                        <option>Neuva Ecija</option>
                                        <option>San Mateo</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mr-sm-1">Status:</label>
                                    <select class="form-control form-control-sm mr-sm-2" id="exampleFormControlSelect1">
                                        <option>For Confirmation Call</option>
                                        <option>For Saturation</option>
                                        <option>For Re-Saturation</option>
                                        <option>For Follow-up Call</option>
                                        <option>For Presentation</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="mr-sm-1">Industry:</label>
                                    <select class="form-control form-control-sm mr-sm-2" id="exampleFormControlSelect1">
                                        <option>Coffe Store</option>
                                        <option>Pizza Restaurant</option>
                                        <option>Drug Store</option>
                                        <option>Clothing Apparel</option>
                                        <option>Hotel</option>
                                    </select>
                                </div>
                                <input class="form-control form-control-sm mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                                <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">
                                    <span class="fa fa-search"></span>&nbsp; Search
                                </button>
                            </form>

                    </div>
                </div>
            </div>
            <div class="card card-default rounded-0">
                <div class="card-body p-2">
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

