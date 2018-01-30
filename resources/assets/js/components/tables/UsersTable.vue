<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="search" class="form-inline float-right mt-2 mb-2">
                    <div class="form-group">
                        <label for="staticEmail" class="col-form-label mr-1">ADVANCE</label>
                        <button @click="dropdownMenuClick" class="mr-sm-2 btn btn-sm btn-default" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="fa fa-th"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-filter">
                            <h6 class="dropdown-header py-0">Filter By Entry Date</h6>
                            <div class="px-4 py-2 form-inline">
                                <div class="form-group">
                                    <label for="exampleDropdownFormEmail1" class="mr-1">From</label>
                                    <input v-model="user_query.from_date" type="date" class="form-control form-control-sm mr-sm-2" id="exampleDropdownFormEmail1">
                                    <label for="exampleDropdownFormPassword1" class="mr-1">To</label>
                                    <input v-model="user_query.to_date" type="date" class="form-control form-control-sm mr-sm-2" id="exampleDropdownFormPassword1">
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>

                            <div class="px-4 py-2 form-inline">
                                <div class="form-group">
                                    <label for="staticEmail" class="col-form-label mr-1">PER PAGE</label>
                                    <select @change="togglePerpage" v-model="user_query.per_page" name="" id="" class="form-control mr-2 form-control-sm">
                                        <option v-for="(value, index) in page_display" :key="index" :value="value">{{ value }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="staticEmail" class="col-form-label mr-1">COLUMN</label>
                                    <select @change="toggleSort" v-model="user_query.sort_column" name="" id="" class="form-control mr-2 form-control-sm">
                                        <option v-for="(column, index) in columns" :key="index" :value="column">{{ column }}</option>
                                    </select>
                                    <label for="staticEmail" class="col-form-label mr-1">ORDER</label>
                                    <select @change="toggleSort" v-model="user_query.order_by" name="" id="" class="form-control mr-2 form-control-sm">
                                        <option value="asc">ASCENDING</option>
                                        <option value="desc">DESCENDING</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input v-model="user_query.search_keyword" style="width:250px;" class="form-control form-control-sm mr-sm-2" type="text" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">
                            <span class="fa fa-search"></span>&nbsp; Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PROFILE</th>
                    <th>NAME</th>
                    <th>INITIAL</th>
                    <th>EMAIL</th>
                    <th>USER TYPE</th>
                    <th>DATE CREATED</th>
                    <th>OPTIONS</th>
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
                <tr v-else-if="users.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="user in users.data" :key="user.id">
                    <td style="vertical-align: middle;">
                        {{ user.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        <!-- {{ user.uid }} -->
                        <img height="50" width="50" class="rounded-cirlce" :src="user.user_img != null ? user.user_img : '/images/default-user.png'"/>
                    </td>
                    <td style="vertical-align: middle;">
                        {{ user.name }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ user.initial }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ user.email }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ user.userType }}
                        <!-- {{ user.user_type.userType }} ({{ user.user_type.id }}) -->
                    </td>
                    <td style="vertical-align: middle;">
                        {{ user.created_at | humanReadableFormat }}
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(user)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button type="button" title="View" class="btn btn-sm btn-default" @click="view(user)">
                                <span class="fa fa-eye"></span>
                            </button>

                            <button @click="destroy(user)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <pagination scope="users" :object="users" 
                :url="`api/users?keyword=${this.user_query.search_keyword}&order_by=${this.user_query.order_by}&per_page=${this.user_query.per_page}&sort_column=${this.user_query.sort_column}`"
                :query="`keyword=${this.user_query.search_keyword}&order_by=${this
                .user_query.order_by}&per_page=${this.user_query
                .per_page}&sort_column=${this.user_query.sort_column}`"
                classSize="pagination-sm">
        </pagination>

    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        mounted(){
            this.loadUsersData();

            Echo.private('user-channel')
            .listen('UserEvent', (e) => {
                console.log(e);
                this.loadUsersData();
            });
        },
        data(){
            return {

            }
        },
        computed:{
            user_query() {
                return this.$store.getters.getUserApiQuery;
            },
            columns() {
                return this.$store.getters.getColumns;
            },
            page_display() {
                return this.$store.getters.getPageDisplay;
            },
            isLoading() {
                return this.$store.getters.getLoadingState;
            },
            currUrl () {
                return this.$store.getters.getCurrUrl;
            },
            users () {
                return this.$store.getters.loadUsers;
            },
            modalForm () {
                return this.$store.getters.getModalForm;
            },
            pages () {
                return this.$store.getters.getTotalPage; 
            }
        },
        filters:{
           
        },
        methods:{
            dropdownMenuClick() {
                $(".dropdown-filter").on("click", function (e) {
                    e.stopPropagation();
                });
            },
            toggleSort() {
                // console.log(this.user_query.order_by)
                let query = {
                    search_keyword: this.user_query.search_keyword,
                    order_by: this.user_query.order_by,
                    per_page: this.user_query.per_page,
                    sort_column: this.user_query.sort_column,
                    
                };

                this.$store.dispatch("setUserApiQuery", query).then(() => {
                   this.loadUsersData();
                });
            },
            togglePerpage() {
                // console.log(this.user_query.order_by)
                let query = {
                    search_keyword: this.user_query.search_keyword,
                    order_by: this.user_query.order_by,
                    per_page: this.user_query.per_page,
                    sort_column: this.user_query.sort_column,
                    
                };

                this.$store.dispatch("setUserApiQuery", query).then(() => {
                    this.loadUsersData();
                });
            },
            loadUsersData() {
                return this.$store.dispatch('loadUsers', 
                `api/users?keyword=${this.user_query.search_keyword}&order_by=${this
                    .user_query.order_by}&per_page=${this.user_query
                    .per_page}&sort_column=${this.user_query.sort_column}`
                );
            },
            edit(user){
                this.$store.dispatch('setModalTitle', 'Edit User Details');
                this.$store.dispatch('loadUser', user);
                this.$store.dispatch('setModalFormType', 'EditUser');
                $("#createUserModal").modal("show");
            },
            view(user){

            },
            destroy(user){
                let deletionType = {
                    scope: "users",
                    user: user
                };

                let message = `This user may be related to existing client record(s)!
                Delete ${user.name} record anyway?`;

                this.$store.dispatch("setModalTitle", message);
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            },
            search() {
                let query = {
                    search_keyword: this.user_query.search_keyword,
                    order_by: this.user_query.order_by,
                    per_page: this.user_query.per_page,
                    sort_column: this.user_query.sort_column,
                   
                };

                this.$store.dispatch("setUserApiQuery", query).then(() => {
                    this.loadUsersData();
                });
            }
        },
        components:{
            Pagination
        }
    }
</script>

<style scoped>
    
</style>
