<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>UID</th>
                    <th>NAME</th>
                    <th>INITIAL</th>
                    <th>EMAIL</th>
                    <th>USER TYPE</th>
                    <th>DATE CREATED</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
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
                        {{ user.user_type.userType }}
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
        
        <pagination scope="users" :object="users" url="api/users"></pagination>
        <!-- <nav aria-label="...">
            <ul class="pagination justify-content-center">
                <li :class="users.first_page_url == null ? 'page-item disabled' : '' ">
                    <a class="page-link" @click.prevent="firstPage(users.first_page_url)" href="#" tabindex="-1"><span class="fa fa-long-arrow-left"></span></a>
                </li>
                <li :class="users.prev_page_url == null ? 'page-item disabled' : 'page-item'">
                    <a class="page-link" @click.prevent="prevPage(users.prev_page_url)" href="#" tabindex="-1">Previous</a>
                </li>
                <li :class="users.current_page == i ? 'page-item active':'active'" v-for="i in users.last_page" :key="i">
                    <a class="page-link" @click.prevent="toPage(i)" href="#">{{ i }}</a>
                </li>
                <li :class="users.next_page_url == null ? 'page-item disabled' : 'page-item'">
                    <a class="page-link" @click.prevent="nextPage(users.next_page_url)" href="#">Next</a>
                </li>
                <li :class="users.last_page_url == null ? 'page-item disabled' : '' ">
                    <a class="page-link" @click.prevent="lastPage(users.last_page_url)" href="#"><span class="fa fa-long-arrow-right"></span></a>
                </li>
            </ul>
        </nav> -->
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        mounted(){
            this.$store.dispatch('loadUsers', this.currUrl);
            this.$store.dispatch('loadUserTypes');
        },
        data(){
            return {

            }
        },
        computed:{
            currUrl () {
                return this.$store.getters.getCurrUrl;
            },
            users () {
                return this.$store.getters.loadUsers;
            },
            userTypes () {
                return this.$store.getters.loadUserTypes;
            },
            modalForm () {
                return this.$store.getters.getModalForm;
            },
            pages () {
                return this.$store.getters.getTotalPage; 
            }
        },
        filters:{
            humanReadableFormat(date) {
                return moment(date).format('MMMM Do, YYYY');
            }
        },
        methods:{
            // toPage(page){
            //     var url = this.currUrl + "?page=" + page;
            //     this.$store.dispatch('loadUsers', url);
            // },
            // nextPage (url) {
            //     this.$store.dispatch('loadUsers', url);
            // },
            // prevPage (url) {
            //     this.$store.dispatch('loadUsers', url);
            // },
            // firstPage(url){
            //     //console.log(url)
            //     this.$store.dispatch('loadUsers', url);
            // },
            // lastPage(url){
            //     //console.log(url)
            //     this.$store.dispatch('loadUsers', url);
            // },
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

                this.$store.dispatch('setModalTitle', "Delete " + user.name + " record?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            }
        },
        components:{
            Pagination
        }
    }
</script>

<style scoped>
    
</style>
