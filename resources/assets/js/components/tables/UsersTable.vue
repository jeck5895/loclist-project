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

    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        mounted(){
            this.$store.dispatch('loadUsers', this.currUrl);
        },
        data(){
            return {

            }
        },
        computed:{
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
