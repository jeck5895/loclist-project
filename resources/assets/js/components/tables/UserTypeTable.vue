<template>
    <div>
        <table class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>USER TYPE</th>
                    <th>DATE CREATED</th>
                    <th>Status</th>
                    <th>OPTIONS</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-if="isLoading">
                    <td colspan="11" class="text-center">
                    <div v-if="isLoading" class="card-body">
                            <div class="img-loading-container">
                                <img src="/images/spinner.gif" class="img-sm">
                            </div>   
                        </div>
                    </td>
                </tr> -->
                 <tr v-if="user_types.data == 0">
                    <td colspan="7" class="text-center">
                        No data to show...
                    </td>
                </tr>

                <tr v-else v-for="(user_type, index) in user_types.data" :key="index">
                   <td style="vertical-align: middle;">
                        {{ user_type.id }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ user_type.userType }}
                    </td>
                    <td style="vertical-align: middle;">
                        {{ user_type.created_at | humanReadableFormat}}
                    </td>
                    <td style="vertical-align: middle;">
                        <span v-if="user_type.is_active == 1" class="bg-success p-1 text-white"> <strong><small>Active</small></strong></span>
                        <span v-if="user_type.is_active == 0" class="bg-danger p-1 text-white"> <strong><small>Inactive</small></strong></span>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(user_type)">
                                <span class="fa fa-edit"></span>
                            </button>

                            <button @click="destroy(user_type)" type="button" class="btn btn-sm btn-default">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <pagination scope="user_types" :object="user_types" url="api/user_types" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadUserTypes', 'api/user_types');
        },
        computed: {
            isLoading() {
            return this.$store.getters.getLoadingState;  
            },
            user_types() {
                return this.$store.getters.getUserTypes;
            },
        },
        methods: {
            edit(user_type) {
                this.$store.dispatch('setModalFormType', 'EDIT_USERTYPE').then(() => {
                    this.$store.dispatch('setModalTitle', 'Edit User type');
                    this.$store.dispatch('loadUserType', user_type);  
                    $("#createUserModal").modal("show");
                    this.$store.dispatch('setLoadingState', true);
                });
            },
            destroy(user_type) {
                let deletionType = {
                        scope: "user_types",
                        user_type: user_type
                    };

                this.$store.dispatch('setModalTitle', "Delete " + user_type.userType + " ?");
                this.$store.dispatch('setDeletionType', deletionType);
                this.$store.dispatch('showConfirmationModal');
            }
        },
        components:{
            Pagination
        }
    }
</script>

<style>

</style>
