<template>
    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <th>REF</th>
                <th style="width:300px;">CLIENT</th>
                <th style="width:200px;">CONTACT PERSON</th>
                <th style="width:150x;">MOBILE #</th>
                <th style="width:150px;">EMAIL</th>
                <th>ENTRY DATE</th>
                <th>Actions</th>
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
            <tr else v-for="(client, index) in clients" :key="index">
                <td style="vertical-align: middle;">
                    {{ client.client_id }}
                </td>
                <td style="vertical-align: middle;">
                    {{ client.client_name }}
                </td>
                <td>
                    <span v-for="(contact_person, index) in client.contact_persons" :key="index">
                        {{ (client.contact_persons.length-1 != index) ? contact_person.first_name + ' ' + contact_person.last_name + ', ' :  contact_person.first_name + ' ' + contact_person.last_name }}
                    </span>
                </td>
                <td>
                    <span v-for="(contact_person, index) in client.contact_persons" :key="index">
                        {{ (client.contact_persons.length-1 != index) ? contact_person.mobile_number+ ', ' :  contact_person.mobile_number }}
                    </span>
                </td>
                <td>
                    <span v-for="(contact_person, index) in client.contact_persons" :key="index">
                        {{ (client.contact_persons.length-1 != index) ? contact_person.email+ ', ' :  contact_person.email }}
                    </span>
                </td>
                <td style="vertical-align: middle;">
                    {{ client.created_at | shortDateTime }}
                </td>
                <td style="vertical-align: middle">
                    <a href="#" @click.prevent="navigateTo({ name: 'viewClient', params: { companyName:  $root.toUrlFormat(client.client_name), clientId : client.client_id }})"
                        class="btn btn-sm btn-default"
                        :title="'Edit ' + client.client_name"
                        :target="client.id">
                        <span class="fa fa-eye"></span>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        computed: {
            clients() {
                return this.$store.getters.getPendingTaskClientList;
            },
            isLoading() {
                return this.$store.getters.getPendingTasksClientListLoadingState;
            },
            task_parameters() {
                return this.$store.getters.getModalParams;
            }

        },
        methods: {
            loadClientList() {
                this.$store.dispatch('loadPendingTaskClientList', this.task_parameters);
            },
            navigateTo(url){
                $("#table-modal").modal("hide");
                this.$router.push(url);
            }
        },
        watch: {
            task_parameters: {
                handler(val){
                    this.loadClientList();
                },
                deep: true
            }
        },
        created() {
            this.loadClientList();
            Echo.private("client-channel").listen("ClientSubrecordEvent", e => {
               this.loadClientList();
            });
        },
        destroyed() {
            Echo.leave("client-channel");
        }
    }
</script>

<style>

</style>
