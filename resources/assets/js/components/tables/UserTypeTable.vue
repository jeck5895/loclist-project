<template>
    <div class="table-responsive">
        <table id="user-type-table" class="table table-borderless table-striped m-b-none">
            <thead>
                <tr>
                    <th>Ref</th>
                    <th style="min-width: 110px">User Role</th>
                    <th style="min-width: 75px"><i class="fa fa-plus"></i> CLIENTS</th>
                    <th style="min-width: 75px"><i class="fa fa-edit"></i> CLIENTS</th>
                    <th style="min-width: 75px"><i class="fa fa-trash"></i> CLIENTS</th>

                    <th style="min-width: 75px"><i class="fa fa-plus"></i> CALLS</th>
                    <th style="min-width: 75px"><i class="fa fa-edit"></i> CALLS</th>
                    <th style="min-width: 75px"><i class="fa fa-trash"></i> CALLS</th>

                    <th style="min-width: 100px"><i class="fa fa-plus"></i> SATURATIONS</th>
                    <th style="min-width: 100px"><i class="fa fa-edit"></i> SATURATIONS</th>
                    <th style="min-width: 100px"><i class="fa fa-trash"></i> SATURATIONS</th>

                    <th style="min-width: 110px"><i class="fa fa-plus"></i> PRESENTATIONS</th>
                    <th style="min-width: 110px"><i class="fa fa-edit"></i> PRESENTATIONS</th>
                    <th style="min-width: 110px"><i class="fa fa-trash"></i> PRESENTATIONS</th>

                    <th style="min-width: 100px"><i class="fa fa-plus"></i> ACQUISITIONS</th>
                    <th style="min-width: 100px"><i class="fa fa-edit"></i> ACQUISITIONS</th>
                    <th style="min-width: 100px"><i class="fa fa-trash"></i> ACQUISTIONS</th>

                    <th style="min-width: 75px"><i class="fa fa-plus"></i> USERS</th>
                    <th style="min-width: 75px"><i class="fa fa-edit"></i> USERS</th>
                    <th style="min-width: 75px"><i class="fa fa-trash"></i> USERS</th>
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

                <tr v-else v-for="(user_type, index) in user_roles" :key="index">
                   <td style="vertical-align: middle;">
                        {{ user_type.id }}
                    </td>

                    <td style="vertical-align: middle;">
                        {{ user_type.userType }}
                    </td>
                    
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.add_clients"
                            @change="changeRole(user_type)"/>
                    </td>

                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.edit_clients"
                            @change="changeRole(user_type)"/>
                    </td>

                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.delete_clients"
                            @change="changeRole(user_type)"/>
                    </td>
                    <!-- client calls -->
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.add_client_calls"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.edit_client_calls"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.delete_client_calls"
                            @change="changeRole(user_type)"/>
                    </td>
                    <!-- client saturations -->
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.add_client_saturations"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.edit_client_saturations"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"   
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.delete_client_saturations"
                            @change="changeRole(user_type)"/>
                    </td>
                    <!-- client presentations -->
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.add_client_presentations"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.edit_client_presentations"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.delete_client_presentations"
                            @change="changeRole(user_type)"/>
                    </td>
                    <!-- client acquisitions -->
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.add_client_acquisitions"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.edit_client_acquisitions"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.delete_client_acquisitions"
                            @change="changeRole(user_type)"/>
                    </td>
                    <!-- users  -->
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.add_user"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.edit_user"
                            @change="changeRole(user_type)"/>
                    </td>
                    <td style="vertical-align: middle;">
                        <toggle-button :value="true"
                            :color="{checked: '#28a745' , unchecked: '#bd362f'}"
                            :width="42"
                            :height="17"
                            :labels="{checked: 'Yes', unchecked: 'No'}"
                            :sync="true" 
                            :key="index"
                            v-model="user_type.delete_user"
                            @change="changeRole(user_type)"/>
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
        
        <pagination scope="user_types" :object="user_types" url="api/maintenance/user_types" classSize="pagination-sm"></pagination>
    </div>
</template>

<script>
    import Pagination from '../pagination/Pagination';

    export default {
        created() {
            this.$store.dispatch('loadUserTypes', 'api/maintenance/user_types');
        },
        data() {
            return {
                user_roles: []
            }
        },
        computed: {
            isLoading() {
            return this.$store.getters.getLoadingState;  
            },
            user_types() {
                return this.$store.getters.getUserTypes;
            },
        },
        watch:{
            user_types: 'translateToBoolean'
        },
        methods: {
            translateToBoolean() {
                this.user_roles = [];
                let role = null;
                this.user_types.data.forEach(element => {
                    role = {
                        id: element.id,
                        userType: element.userType,
                        add_clients : element.add_clients == 1 ? true : false,
                        edit_clients : element.edit_clients == 1 ? true : false,
                        delete_clients : element.delete_clients == 1 ? true : false,
                        add_client_calls : element.add_client_calls == 1 ? true : false,
                        edit_client_calls : element.edit_client_calls == 1 ? true : false,
                        delete_client_calls : element.delete_client_calls == 1 ? true : false,
                        add_client_saturations : element.add_client_saturations == 1 ? true : false,
                        edit_client_saturations : element.edit_client_saturations == 1 ? true : false,
                        delete_client_saturations : element.delete_client_saturations == 1 ? true : false,
                        add_client_presentations : element.add_client_presentations == 1 ? true : false,
                        edit_client_presentations : element.edit_client_presentations == 1 ? true : false,
                        delete_client_presentations : element.delete_client_presentations == 1 ? true : false,
                        add_client_acquisitions : element.add_client_acquisitions == 1 ? true : false,
                        edit_client_acquisitions : element.edit_client_acquisitions == 1 ? true : false,
                        delete_client_acquisitions : element.delete_client_acquisitions == 1 ? true : false,
                        add_user : element.add_user == 1 ? true : false,
                        edit_user : element.edit_user == 1 ? true : false,
                        delete_user : element.delete_user == 1 ? true : false,
                    }
                    this.user_roles.push(role);
                });
                
            },
            changeRole(user_type) {
                console.log(user_type.add_clients)
                let role = {
                    id: user_type.id,
                    userType: user_type.userType,
                    add_clients : user_type.add_clients == true ? 1 : 0,
                    edit_clients : user_type.edit_clients == true ? 1 : 0,
                    delete_clients : user_type.delete_clients == true ? 1 : 0,
                    add_client_calls : user_type.add_client_calls == true ? 1 : 0,
                    edit_client_calls : user_type.edit_client_calls == true ? 1 : 0,
                    delete_client_calls : user_type.delete_client_calls == true ? 1 : 0,
                    add_client_saturations : user_type.add_client_saturations == true ? 1 : 0,
                    edit_client_saturations : user_type.edit_client_saturations == true ? 1 : 0,
                    delete_client_saturations : user_type.delete_client_saturations == true ? 1 : 0,
                    add_client_presentations : user_type.add_client_presentations == true ? 1 : 0,
                    edit_client_presentations : user_type.edit_client_presentations == true ? 1 : 0,
                    delete_client_presentations : user_type.delete_client_presentations == true ? 1 : 0,
                    add_client_acquisitions : user_type.add_client_acquisitions == true ? 1 : 0,
                    edit_client_acquisitions : user_type.edit_client_acquisitions == true ? 1 : 0,
                    delete_client_acquisitions : user_type.delete_client_acquisitions == true ? 1 : 0,
                    add_user : user_type.add_user == true ? 1 : 0,
                    edit_user : user_type.edit_user == true ? 1 : 0,
                    delete_user : user_type.delete_user == true ? 1 : 0,
                };

                this.$store.dispatch('updateUserType', role)
                .then(() => {
                    this.$store.dispatch('loadUserTypes', 'api/maintenance/user_types');
                });
            },
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

<style scoped>
    #user-type-table thead {
        font-size: 12px;
    }
</style>
