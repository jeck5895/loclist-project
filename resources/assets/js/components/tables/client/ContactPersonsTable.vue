<template>
    <table id="contact-persons-table" class="table table-striped table-sm">
        <thead>
            <tr>
                <th style="min-width:100px" scope="col">First name</th>
                <th style="min-width:100px" scope="col">Last name</th>
                <th style="min-width:100px" scope="col">Email</th>
                <th style="min-width:100px" scope="col">Mobile no.</th>
                <th style="min-width:100px" scope="col">Department</th>
                <th style="min-width:100px" scope="col">Position</th>
                <th v-if="displayOptions" scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="contact_persons == 0">
                <td colspan="11" class="text-center">
                    <i class="text-muted">No contact person(s) to show...</i>
                </td>
            </tr>
            <tr v-else v-for="(m, index) in contact_persons" :key="index">
                <td style="vertical-align: middle;">
                    {{ m.first_name }}
                </td>
                <td style="vertical-align: middle;">
                    {{ m.last_name }}
                </td>
                <td style="vertical-align: middle;">
                    {{ m.email }}
                </td>
                <td style="vertical-align: middle;">
                    {{ m.mobile_number }}
                </td>
                <td style="vertical-align: middle;">
                    {{ m.department.department_name }}
                </td>
                <td style="vertical-align: middle;">
                    {{ m.position.position_name }}
                </td>
                <td v-if="displayOptions" style="vertical-align: middle;">
                    <button @click.prevent="removeContactPerson(index)" class="btn btn-sm btn-danger">
                        <span class="fa fa-times-circle"></span>
                        Remove
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props:['clientId', 'displayOptions'],
        created(){
            console.log(this.clientId)
            if(this.clientId){
                this.loadContactPersons();
            }
        },
        computed: {
            contact_persons() {
                return this.$store.getters.getClientContactPersons;
            }
        },
        watch: {
            clientId: 'loadContactPersons'
        },
        methods: {
            removeContactPerson(index){
                this.$store.dispatch('removeContactPerson', index);
            },
            loadContactPersons() {
                let payload = {
                    id: this.clientId
                };
                this.$store.dispatch('loadClient', payload);
            }
        }
    }
</script>

<style>
    #contact-persons-table td {
        font-size: 12px;
    }
</style>