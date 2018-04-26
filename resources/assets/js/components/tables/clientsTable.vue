<template>
    <div>
        <!-- Include Filter here for every table must have filter -->
        <form @submit.prevent="search" class="form-inline float-right mt-2 mb-2">
            <div class="form-group">
                <button type="button" id="dropdownMore" class="mr-sm-2 btn btn-sm btn-default dropdown-toggle dropdown-remove-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    More <i class="fa fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-download"></i> Export to Excel
                    </a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                <label for="staticEmail" class="col-form-label mr-1">Advance</label>
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
                <!-- <label class="mr-1 d-sm-none d-md-none d-lg-block">Filter By Status</label> -->
                <select v-model="client_query.status" class="form-control form-control-sm mr-sm-2" style="max-width:150px" id="exampleFormControlSelect1">
                    <option value="">Filter by Status</option>
                    <option v-for="(status, index) in statuses" :key="index" :value="status.id">{{ status.status }}</option>
                </select>
            </div>

            <div class="form-group">
                <!-- <label class="mr-1 d-sm-none d-md-none d-lg-block">Filter By Industry</label> -->
                <select v-model="client_query.industry" class="form-control form-control-sm mr-sm-2" id="exampleFormControlSelect1" style="max-width:150px">
                    <option value="">Filter by Industry</option>
                    <option v-for="(industry, index) in industries" :key="index" :value="industry.id">{{ industry.industry_name }}</option>
                </select>
            </div>

            <div class="form-group">
                <!-- <label for="staticEmail" class="d-sm-none d-md-none d-lg-block col-form-label mr-1">Location</label> -->
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
        <div class="table-responsive">
            <table id="clients-table" class="table table-borderless table-striped m-b-none">
                <thead>
                    <tr>
                        <th>User</th>
                        <th style="width: 220px;">Client Name</th>
                        <th style="width: 120px;">Contact Person</th>
                        <th style="width: 120px;">Contact #</th>
                        <th style="width: 80px;">Email</th>
                        <th style="width: 100px;">Date of Call</th>
                        <th style="width: 100px;">Date of Saturation</th>
                        <th style="width: 100px;">Date of Presentation</th>
                        <th style="width: 100px;">Follow-up Date</th>
                        <th style="width: 120px;">Task Status</th>
                        <th style="width: 120px;">Negotiation Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="isLoading">
                        <td colspan="12" class="text-center">
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
                        
                        <td v-if="client.user != null" style="vertical-align: middle;">
                            {{ client.user_initial }}
                        </td>

                        <td v-else style="vertical-align: middle;">
                            Removed
                        </td>
                        <!-- Secret -->
                        <td style="vertical-align: middle;">
                            {{ client.client_name }}
                        </td>

                        <td v-if="client.contact_persons[0]" style="vertical-align: middle;">
                            <a v-if="client.contact_persons.length > 1" @click.prevent="showTable(client, 'CONTACT_PERSONS_TABLE')" href="#">{{ client.contact_persons[0].first_name + " " + client.contact_persons[0].last_name }}</a>
                            <span v-else>{{ client.contact_persons[0].first_name + " " + client.contact_persons[0].last_name }}</span>
                        </td>
                        <td v-else style="vertical-align: middle;">
                            <em>No contact person provided</em>
                        </td>

                        <td v-if="client.contact_persons[0]" style="vertical-align: middle;">
                            {{ client.contact_persons[0].mobile_number }}
                        </td>
                        <td v-else style="vertical-align: middle;">
                            <em>No mobile number provided</em>
                        </td>

                        <td v-if="client.contact_persons[0]" style="vertical-align: middle;">
                            {{ client.contact_persons[0].email }}
                        </td>
                        <td v-else style="vertical-align: middle;">
                            <em>No email provided</em>
                        </td>

                        <td v-if="client.latest_call != null" style="vertical-align: middle;">
                            <a @click.prevent="showTable(client, 'CALLS_TABLE')" href="#">{{ client.latest_call | shortDateTime }} </a>
                        </td>
                        <td v-else style="vertical-align: middle;">
                            No record
                        </td>

                        <td v-if="client.latest_saturation != null" style="vertical-align: middle;">
                            <a @click.prevent="showTable(client, 'SATURATIONS_TABLE')" href="#">{{ client.latest_saturation | shortDateTime }}</a>
                        </td>
                        <td v-else style="vertical-align: middle;">
                            No record
                        </td>

                        <td v-if="client.latest_presentation != null" style="vertical-align: middle;">
                            <a @click.prevent="showTable(client, 'PRESENTATIONS_TABLE')" href="#">{{ client.latest_presentation | shortDateTime }} </a>
                        </td>
                        <td v-else style="vertical-align: middle;">
                            No record
                        </td>

                        <td v-if="client.latest_follow_up_date != null" style="vertical-align: middle;">
                            {{ client.latest_follow_up_date | shortDateTime }}
                        </td>
                        <td v-else style="vertical-align: middle;">
                            No record
                        </td>

                        <td v-if="client.task_status != null" style="vertical-align: middle;">
                            <span 
                                :class="client.task_status_id == 1 ? 'badge badge-primary': client.negotiation_status_id == 6 ? 'badge badge-success' : client.negotiation_status_id == 9 ? 'badge badge-danger' : 'badge badge-info'"> 
                                {{ client.task_status }} 
                            </span>
                        </td>
                        <td v-else style="vertical-align: middle;">
                            <span class="badge badge-warning">NO STATUS</span>
                        </td>

                        <td v-if="client.negotiation_status != null" style="vertical-align: middle;">
                            <span 
                                :class="client.negotiation_status_id == 6 ? 'badge badge-success': client.negotiation_status_id == 9 ? 'badge badge-danger' : client.negotiation_status_id == 13 ? 'badge badge-success' : 'badge badge-info'"> 
                                {{ client.negotiation_status }} </span>
                        </td>
                        <td v-else style="vertical-align: middle;">
                            <span class="badge badge-warning">NO STATUS</span>
                        </td>

                        <!-- Edit Button -->
                        <td style="vertical-align: middle;">
                            <div class="btn-group btn-group-sm" role="group">
                                <button v-if="user.user_role.edit_clients == 1" @click="toEditClientForm(client)" :title="'Edit ' + client.client_name" class="btn btn-sm btn-default">
                                    <span class="fa fa-edit"></span>
                                </button>

                                <router-link :to="{ name: 'viewClient', params: { companyName:  $root.toUrlFormat(client.client_name), clientId : client.id }}"
                                    class="btn btn-sm btn-default"
                                    :target="client.id">
                                    <span class="fa fa-eye"></span>
                                </router-link>


                                <button v-if="user.user_role.delete_clients == 1" type="button" title="Delete" class="btn btn-sm btn-default" @click="destroy(client)">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </div>
                        </td>


                    </tr>
                </tbody>
            </table>
        </div>
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
                toastr.info('', e.message.response);
            });
        },
        data() {
            return {
                user : Vue.auth.getter()            
            };
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
                this.$store.dispatch('clearContactPersons');
                this.$store.dispatch('clearClientManpowerProviders');
                this.$router.push({ name: 'editClient', params: { companyName:  this.$root.toUrlFormat(client.client_name), clientId : client.id }})
            },
            destroy(client){
                let deletionType = {
                    scope: "clients",
                    client: client
                };

                let message = `
                <div class="alert alert-danger mb-1" role="alert">
                    <h6 class="alert-heading">Warning <i class="fa fa-exclamation-circle"></i></h6>
                    <small>All records including calls, saturations, presentations and contact person's record will be deleted!</small>
                </div>
                <br>
                <p class="text-center">Delete <em>${client.client_name}</em> record anyway?</p>`;

                this.$store.dispatch("setModalTitle", message);
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
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
            },
            showTable(client, table){
                switch (table) {
                    case 'CALLS_TABLE':
                        this.$store.dispatch('setModalTitle', client.client_name + ' CALL HISTORY');
                        this.$store.dispatch('setModalFormType', 'SHOW_CALLS_TABLE');
                        this.$store.dispatch('setModalParams', client.id);
                        $("#table-modal").modal("show");
                    break;
                    
                    case 'SATURATIONS_TABLE':
                        this.$store.dispatch('setModalTitle', client.client_name + ' SATURATION HISTORY');
                        this.$store.dispatch('setModalFormType', 'SHOW_SATURATIONS_TABLE');
                        this.$store.dispatch('setModalParams', client.id);
                        $("#table-modal").modal("show");
                    break;

                    case 'PRESENTATIONS_TABLE':
                        this.$store.dispatch('setModalTitle', client.client_name + ' PRESENTATION HISTORY');
                        this.$store.dispatch('setModalFormType', 'SHOW_PRESENTATIONS_TABLE');
                        this.$store.dispatch('setModalParams', client.id);
                        $("#table-modal").modal("show");
                    break;

                    case 'CONTACT_PERSONS_TABLE':
                        this.$store.dispatch('setModalTitle', client.client_name + ' LIST OF CONTACT PERSONS ');
                        this.$store.dispatch('setModalFormType', 'SHOW_CONTACT_PERSONS_TABLE');
                        this.$store.dispatch('setModalParams', client.id);
                        $("#table-modal").modal("show");
                    break;
                
                    default:
                        break;
                }
            }
        },
        components: {
            Pagination
        },
        destroyed() {
            Echo.leave("client-channel");
        }
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

    .btn-xs {
        padding: 0.05rem 0.25rem !important;
    }
</style>