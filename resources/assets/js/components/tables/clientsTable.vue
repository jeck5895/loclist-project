<template>
    <div>
        <!-- Include Filter here for every table must have filter -->
        <form @submit.prevent="search" class="form-inline float-right mt-2 mb-2">
            <div class="form-group">
                <label for="staticEmail" class="col-form-label mr-1">ADVANCE</label>
                <button @click="dropdownMenuClick" class="mr-sm-2 btn btn-sm btn-default dropdown-toggle dropdown-remove-arrow" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="fa fa-th"></span>
                </button>
                <div class="dropdown-menu dropdown-filter">
                    <h6 class="dropdown-header py-0">Filter By Entry Date</h6>
                    <div class="px-4 py-2 form-inline">
                        <div class="form-group">
                            <label for="exampleDropdownFormEmail1" class="mr-1">From</label>
                            <input v-model="client_query.from_date" type="date" class="form-control form-control-sm mr-sm-2" id="exampleDropdownFormEmail1">
                            <label for="exampleDropdownFormPassword1" class="mr-1">To</label>
                            <input v-model="client_query.to_date" type="date" class="form-control form-control-sm mr-sm-2" id="exampleDropdownFormPassword1">
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="px-4 py-2 form-inline">
                        <div class="form-group">
                            <label for="staticEmail" class="col-form-label mr-1">PER PAGE</label>
                            <select @change="togglePerpage" v-model="client_query.per_page" name="" id="" class="form-control mr-2 form-control-sm">
                                <option v-for="(value, index) in page_display" :key="index" :value="value">{{ value }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="staticEmail" class="col-form-label mr-1">COLUMN</label>
                            <select @change="toggleSort" v-model="client_query.sort_column" name="" id="" class="form-control mr-2 form-control-sm">
                                <option v-for="(column, index) in columns" :key="index" :value="column">{{ column }}</option>
                            </select>
                            <label for="staticEmail" class="col-form-label mr-1">ORDER</label>
                            <select @change="toggleSort" v-model="client_query.order_by" name="" id="" class="form-control mr-2 form-control-sm">
                                <option value="asc">ASCENDING</option>
                                <option value="desc">DESCENDING</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="mr-1">Filter By Status</label>
                <select v-model="client_query.status" class="form-control form-control-sm mr-sm-2" id="exampleFormControlSelect1">
                    <option value=""></option>
                    <option v-for="(status, index) in statuses" :key="index" :value="status.id">{{ status.status }}</option>
                </select>
            </div>

            <div class="form-group">
                <label class="mr-1">Filter By Industry</label>
                <select v-model="client_query.industry" class="form-control form-control-sm mr-sm-2" id="exampleFormControlSelect1" style="max-width:150px">
                    <option value=""></option>
                    <option v-for="(industry, index) in industries" :key="index" :value="industry.id">{{ industry.industry_name }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="staticEmail" class="col-form-label mr-1">LOCATION</label>
                <input v-model="client_query.location" placeholder="Search by location" type="text" class="form-control form-control-sm mr-sm-2">
            </div>
            <div class="form-group">
                <input v-model="client_query.search_keyword" style="width:250px;" class="form-control form-control-sm mr-sm-2" type="text" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">
                    <span class="fa fa-search"></span>&nbsp; Search
                </button>
            </div>
        </form>
        <table id="clients-table" class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>
                        <span>Ref</span>
                    </th>
                    <th>Entry By</th>
                    <th style="width: 250px;">Client Name</th>
                    <th style="width: 180px;">Contact Person</th>
                    <th>Contact #</th>
                    <th style="width: 100px;">Email</th>
                    <th>Date of Call</th>
                    <th>Date of Saturation</th>
                    <th>Date of Presentation</th>
                    <th>Follow-up Date</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="isLoading">
                    <td colspan="11" class="text-center">
                        <div v-if="isLoading" class="card-body">
                            <div class="img-loading-container">
                                <img src="/images/spinner.gif" class="img-sm">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-else-if="clients.data == 0">
                    <td colspan="11" class="text-center">
                        No data to show...
                    </td>
                </tr>
                <tr v-else v-for="(client, index) in clients.data" :key="index">
                    <!-- ID -->
                    <td style="vertical-align: middle;">
                        {{ client.id }}
                    </td>

                    <!-- Name -->
                    <td style="vertical-align: middle;">
                        {{ client.user.initial }}
                    </td>

                    <!-- Secret -->
                    <td style="vertical-align: middle;">
                        {{ client.client_name }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.contact_person }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.mobile_number }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.email_address }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.date_call }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.saturation_date }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.presentation_date }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ client.followup_date }}
                    </td>

                    <!-- Edit Button -->
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button @click="toEditClientForm(client)" :title="'Edit ' + client.client_name" class="btn btn-sm btn-default">
                                <span class="fa fa-edit"></span>
                            </button>

                            <router-link :to="{ name: 'viewClient', params: { companyName:  toUrlFormat(client.client_name), clientId : client.id }}"
                                class="btn btn-sm btn-default">
                                <span class="fa fa-eye"></span>
                            </router-link>


                            <button type="button" title="Delete" class="btn btn-sm btn-default" @click="destroy(client)">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination scope="clients" :object="clients" 
            :url="`api/clients?keyword=${this.client_query.search_keyword}&order_by=${this.client_query.order_by}&per_page=${this.client_query.per_page}&sort_column=${this.client_query.sort_column}&industry=${this.client_query.industry}&location=${this.client_query.location}&from_date=${this.client_query.from_date}&to_date=${this.client_query.to_date}&status=${this.client_query.status}`"
            :query="`keyword=${this.client_query.search_keyword}&order_by=${this.client_query.order_by}&per_page=${this.client_query.per_page}&sort_column=${this.client_query.sort_column}&industry=${this.client_query.industry}&location=${this.client_query.location}&from_date=${this.client_query.from_date}&to_date=${this.client_query.to_date}&status=${this.client_query.status}`"
            classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from "../pagination/Pagination";
    import router from '../../router/routes';

    export default {
        created() {
            this.loadClientsData();
            Echo.private("client-channel").listen("ClientEvent", e => {
                console.log(e);
                this.loadClientsData();
            });
        },
        data() {
            return {};
        },
        computed: {
            client_query() {
                return this.$store.getters.getClientApiQuery;
            },
            page_display() {
                return this.$store.getters.getPageDisplay;
            },
            columns() {
                return this.$store.getters.getColumns;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            },
            clients() {
                return this.$store.getters.getClients;
            },
            industries() {
                return this.$store.getters.getIndustries;
            },
            statuses() {
                return this.$store.getters.getStatuses;
            }
        },
        methods: {
            toEditClientForm(client) {
                localStorage.setItem('f_type', 'EDIT_CLIENT');
                this.$store.dispatch('clearClientManpowerProviders');
                this.$router.push({ name: 'editClient', params: { companyName:  this.toUrlFormat(client.client_name), clientId : client.id }})
            },
            dropdownMenuClick() {
                $(".dropdown-filter").on("click", function (e) {
                    e.stopPropagation();
                });
            },
            toggleSort() {
                // console.log(this.client_query.order_by)
                let query = {
                    search_keyword: this.client_query.search_keyword,
                    order_by: this.client_query.order_by,
                    per_page: this.client_query.per_page,
                    sort_column: this.client_query.sort_column,
                    location: this.client_query.location,
                    industry: this.client_query.industry,
                    from_date: this.client_query.from_date,
                    to_date: this.client_query.to_date,
                    status: this.client_query.status
                };

                this.$store.dispatch("setClientApiQuery", query).then(() => {
                    this.loadClientsData();
                });
            },
            togglePerpage() {
                // console.log(this.client_query.order_by)
                let query = {
                    search_keyword: this.client_query.search_keyword,
                    order_by: this.client_query.order_by,
                    per_page: this.client_query.per_page,
                    sort_column: this.client_query.sort_column,
                    location: this.client_query.location,
                    industry: this.client_query.industry,
                    from_date: this.client_query.from_date,
                    to_date: this.client_query.to_date,
                    status: this.client_query.status
                };

                this.$store.dispatch("setClientApiQuery", query).then(() => {
                    this.loadClientsData();
                });
            },
            toUrlFormat(param) {
                let temp = param.replace(/[^a-zA-Z0-9\s\-]/g, "");
                return temp.replace(/\s+/g, "-").toLowerCase();
            },
            loadClientsData() {
                //console.log(this.client_query);
                return this.$store.dispatch(
                    "loadClients",
                    `api/clients?keyword=${this.client_query.search_keyword}&order_by=${this.client_query.order_by}&per_page=${this.client_query.per_page}&sort_column=${this.client_query.sort_column}&industry=${this.client_query.industry}&location=${this.client_query.location}&from_date=${this.client_query.from_date}&to_date=${this.client_query.to_date}&status=${this.client_query.status}`
                );
            },
            search() {
                let query = {
                    search_keyword: this.client_query.search_keyword,
                    order_by: this.client_query.order_by,
                    per_page: this.client_query.per_page,
                    sort_column: this.client_query.sort_column,
                    location: this.client_query.location,
                    industry: this.client_query.industry,
                    from_date: this.client_query.from_date,
                    to_date: this.client_query.to_date,
                    status: this.client_query.status
                };

                this.$store.dispatch("setClientApiQuery", query).then(() => {
                    this.loadClientsData();
                });
            }
        },
        components: {
            Pagination
        },
        filters: {}
    };
</script>

<style scoped>
    button {
        cursor: pointer;
    }

    #clients-table {
        font-size: 12px;
    }

    .table th,
    .table td {
        padding: 0.25rem;
    }

    .dropdown-toggle::after {
        display: none;
    }

</style>