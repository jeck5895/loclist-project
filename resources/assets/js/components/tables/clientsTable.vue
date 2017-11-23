<template>
    <table id="clients-table" class="table table-borderless table-striped m-b-none" v-if="clients.length > 0">
        <thead>
            <tr>
                <th>Ref</th>
                <th>Entry By</th>
                <th>Client Name</th>
                <th>Contact Person</th>
                <th>Contact #</th>
                <th>Email</th>
                <th>Date of Call</th>
                <th>Date of Saturation</th>
                <th>Date of Presentation</th>
                <th>Follow-up Date</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="client in clients" :key="client.id">
                <!-- ID -->
                <td style="vertical-align: middle;">
                    {{ client.id }}
                </td>

                <!-- Name -->
                <td style="vertical-align: middle;">
                    {{ client.entry_by }}
                </td>

                <!-- Secret -->
                <td style="vertical-align: middle;">
                    {{ client.client_name }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.contact_person }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.contact_no }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.email }}
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
                        <button type="button" title="Edit" class="btn btn-sm btn-default" @click="edit(client)">
                            <span class="fa fa-edit"></span>
                        </button>

                        <button type="button" title="View" class="btn btn-sm btn-default" @click="view(client)">
                            <span class="fa fa-eye"></span>
                        </button>

                        <button type="button" title="Delete" class="btn btn-sm btn-default" @click="destroy(client)">
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
    mounted() {

    },
    data() {
        return {
            clients: [
                {
                    id: 1,
                    entry_by: "Peter John Jude",
                    client_name: "Microsoft Windows",
                    contact_person: "John Doe",
                    contact_no: '+63916-285-9262',
                    email: "john.doe@gmail.com",
                    date_call: moment().format('MMM Do YYYY'),
                    saturation_date: moment().format('MMM Do YYYY'),
                    presentation_date: moment().format('MMM Do YYYY'),
                    followup_date: moment().format('MMM Do YYYY'),

                },
                {
                    id: 2,
                    entry_by: "John Duhat",
                    client_name: "Microsoft Windows",
                    contact_person: "John Doe",
                    contact_no: '+63916-285-9262',
                    email: "john.doe@gmail.com",
                    date_call: moment().format('MMM Do YYYY'),
                    saturation_date: moment().format('MMM Do YYYY'),
                    presentation_date: moment().format('MMM Do YYYY'),
                    followup_date: moment().format('MMM Do YYYY'),

                },
                {
                    id: 3,
                    entry_by: "John Duhat",
                    client_name: "Microsoft Windows",
                    contact_person: "John Doe",
                    contact_no: '+63916-285-9262',
                    email: "john.doe@gmail.com",
                    date_call: moment().format('MMM Do YYYY'),
                    saturation_date: moment().format('MMM Do YYYY'),
                    presentation_date: moment().format('MMM Do YYYY'),
                    followup_date: moment().format('MMM Do YYYY'),

                },
                {
                    id: 4,
                    entry_by: "John Duhat",
                    client_name: "Microsoft Windows",
                    contact_person: "John Doe",
                    contact_no: '+63916-285-9262',
                    email: "john.doe@gmail.com",
                    date_call: moment().format('MMM Do YYYY'),
                    saturation_date: moment().format('MMM Do YYYY'),
                    presentation_date: moment().format('MMM Do YYYY'),
                    followup_date: moment().format('MMM Do YYYY'),

                },
                {
                    id: 5,
                    entry_by: "John Duhat",
                    client_name: "Microsoft Windows",
                    contact_person: "John Doe",
                    contact_no: '+63916-285-9262',
                    email: "john.doe@gmail.com",
                    date_call: moment().format('MMM Do YYYY'),
                    saturation_date: moment().format('MMM Do YYYY'),
                    presentation_date: moment().format('MMM Do YYYY'),
                    followup_date: moment().format('MMM Do YYYY'),

                },
            ]
        }
    },
    methods: {
        view(client){
			console.log(client.id);
			/* Set modal necessary modal info for displaying the right form/data */
            this.$store.dispatch('setModalTitle', 'Edit Client Details');
            //this.$store.dispatch('loadUser', user); load client details instead for viewing
            this.$store.dispatch('setModalFormType', 'EditClient');
            $("#createUserModal").modal("show");
        },
        edit(client) {
			console.log(client);
			/* Navigation to new page for editing client because of lots no.of forms */
        },
        destroy(client) {
            // axios.delete('/oauth/clients/' + client.id)
            //         .then(response => {
            //             this.getClients();
            //         });
            console.log(client)
        }
    }
}
</script>

<style scoped>
    button {
        cursor: pointer;
    }
    
    .table th, .table td{
        padding: 0.25rem;
    }
</style>
