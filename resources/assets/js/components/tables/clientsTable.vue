<template>
    <table id="clients-table" class="table table-borderless table-striped m-b-none" v-if="clients.length > 0">
        <thead>
            <tr>
                <th>Ref</th>
                <th>Entry By</th>
                <th>Overall Status</th>
                <th>Entry Date</th>
                <th>Client Name</th>
                <th>Industry</th>
                <th>Nationality</th>
                <th>ISO Certification</th>
                <th>Mailing Address</th>
                <th>Street/Brgy/Town</th>
                <th>City/Province</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="client in clients">
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
                    {{ client.o_status }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.entry_date }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.client_name }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.industry }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.nationality }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.iso_cetification }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.mailing_address }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.street_address }}
                </td>

                <td style="vertical-align: middle;">
                    {{ client.province }}
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
                    entry_by: "John Duhat",
                    o_status: "For Follow-up Call",
                    entry_date: moment().format('MMMM Do YYYY'),
                    client_name: "ARMY NAVY",
                    industry: "Food Service",
                    nationality: "Filipino",
                    iso_certification: "",
                    mailing_address: "Jupiter St, Makati, Metro Manila",
                    street_address: "007 Shopwise Arcade, Araneta Center",
                    province: "Quezon City"

                },
                {
                    id: 2,
                    entry_by: "John Duhat",
                    o_status: "For Follow-up Call",
                    entry_date: moment().format('MMMM Do YYYY'),
                    client_name: "ARMY NAVY",
                    industry: "Food Service",
                    nationality: "Filipino",
                    iso_certification: "",
                    mailing_address: "Jupiter St, Makati, Metro Manila",
                    street_address: "007 Shopwise Arcade, Araneta Center",
                    province: "Quezon City"

                },
                {
                    id: 3,
                    entry_by: "John Duhat",
                    o_status: "For Follow-up Call",
                    entry_date: moment().format('MMMM Do YYYY'),
                    client_name: "ARMY NAVY",
                    industry: "Food Service",
                    nationality: "Filipino",
                    iso_certification: "",
                    mailing_address: "Jupiter St, Makati, Metro Manila",
                    street_address: "007 Shopwise Arcade, Araneta Center",
                    province: "Quezon City"

                },
                {
                    id: 4,
                    entry_by: "John Duhat",
                    o_status: "For Follow-up Call",
                    entry_date: moment().format('MMMM Do YYYY'),
                    client_name: "ARMY NAVY",
                    industry: "Food Service",
                    nationality: "Filipino",
                    iso_certification: "",
                    mailing_address: "Jupiter St, Makati, Metro Manila",
                    street_address: "007 Shopwise Arcade, Araneta Center",
                    province: "Quezon City"

                },
                {
                    id: 5,
                    entry_by: "John Duhat",
                    o_status: "For Follow-up Call",
                    entry_date: moment().format('MMMM Do YYYY'),
                    client_name: "ARMY NAVY",
                    industry: "Food Service",
                    nationality: "Filipino",
                    iso_certification: "",
                    mailing_address: "Jupiter St, Makati, Metro Manila",
                    street_address: "007 Shopwise Arcade, Araneta Center",
                    province: "Quezon City"

                },
            ]
        }
    },
    methods: {
        view(client){
            console.log(client.id);
        },
        edit(client) {
            console.log(client)
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
</style>
