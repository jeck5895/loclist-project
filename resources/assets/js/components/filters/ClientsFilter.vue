<template>
    <form @submit.prevent="search" class="form-inline float-right mt-2 mb-2" style="">
        <div class="form-group">
            <button class="mr-sm-2 btn btn-sm btn-default dropdown-toggle dropdown-remove-arrow" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="fa fa-th"></span>
            </button>
            <div @click="dropdownMenuClick" class="dropdown-menu dropdown-menu-right dropdown-filter">
                <h6 class="dropdown-header py-0">Filter By Entry Date</h6>
                <div class="px-4 py-2">
                    <div class="form-group">
                        <label for="exampleDropdownFormEmail1">From</label>
                        <input v-model="from_date" type="date" class="form-control form-control-sm" id="exampleDropdownFormEmail1" style="width:100%;">
                    </div>
                    <div class="form-group">
                        <label for="exampleDropdownFormPassword1">To</label>
                        <input v-model="to_date" type="date" class="form-control form-control-sm" id="exampleDropdownFormPassword1" style="width:100%;">
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header py-0">Filter By Location</h6>
                <div class="px-4 py-2">
                    <div class="form-group">
                        <select v-model="location" class="form-control form-control-sm" id="exampleFormControlSelect1" style="width:100%;">
                            <option>Metro Manila</option>
                            <option>Abra</option>
                            <option>Bulacan</option>
                            <option>Neuva Ecija</option>
                            <option>San Mateo</option>
                        </select>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header py-0">Filter By Status</h6>
                <div class="px-4 py-2">
                    <div class="form-group">
                        <select v-model="status" class="form-control form-control-sm" id="exampleFormControlSelect1" style="width:100%;">
                            <option>For Confirmation Call</option>
                            <option>For Saturation</option>
                            <option>For Re-Saturation</option>
                            <option>For Follow-up Call</option>
                            <option>For Presentation</option>
                        </select>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header py-0">Filter By Industry</h6>
                <div class="px-4 py-2">
                    <div class="form-group">
                        <select v-model="industry" class="form-control form-control-sm" id="exampleFormControlSelect1" style="width:100%;">
                            <option>Coffe Store</option>
                            <option>Pizza Restaurant</option>
                            <option>Drug Store</option>
                            <option>Clothing Apparel</option>
                            <option>Hotel</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input v-model="keyword" style="width:250px;" class="form-control form-control-sm mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">
                <span class="fa fa-search"></span>&nbsp; Search
            </button>
        </div>
    </form>
</template>

<script>
export default {
    created() {

    },
    data() {
        return {
            keyword: '',
            from_date: '',
            to_date: '',
            location:'',
            status:'',
            industry:''
        }
    },
    computed:{
        api_query() {
            return this.$store.getters.getClientApiQuery;
        }
    },
    methods: {
        dropdownMenuClick() {
            $(".dropdown-filter").on("click", function(e) {
                e.stopPropagation();
            });
        },
        search() {
            let query = {
                search_keyword : this.keyword,
                order_by: 'asc',
                per_page: 10
            };
            
            this.$store.dispatch('setClientApiQuery', query)
            .then(response => {
                console.log(response)
                this.$store.dispatch("loadClients", `api/clients?keyword=${this.api_query.search_keyword}&order_by=${this.api_query.order_by}&per_page=${this.api_query.per_page}`)
            })
            .catch(error => {
                toastr.error('Error', 'Oops something went wrong')
            });
        }
    }
};
</script>

<style scoped>
    .dropdown-toggle::after {
    display: none;
    }

    .dropdown-menu {
    width: 250px;
    }
</style>