<template>
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
            <tr v-for="user in users">
                <td style="vertical-align: middle;">
                    {{ user.id }}
                </td>
                <td style="vertical-align: middle;">
                    {{ user.uid }}
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

                        <button type="button" title="Delete" class="btn btn-sm btn-default" @click="destroy(user)">
                            <span class="fa fa-trash"></span>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        mounted(){
            this.$store.dispatch('loadUsers');
            this.$store.dispatch('loadUserTypes');
        },
        data(){
            return {
               
            }
        },
        computed:{
            users(){
                return this.$store.getters.loadUsers;
            },
            userTypes(){
                return this.$store.getters.loadUserTypes;
            },
            modalForm(){
                return this.$store.getters.getModalForm;
            }
        },
        filters:{
            humanReadableFormat(date){
                return moment(date).format('MMMM Do, YYYY');
            }
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
            delete(user){

            }
        }
    }
</script>

