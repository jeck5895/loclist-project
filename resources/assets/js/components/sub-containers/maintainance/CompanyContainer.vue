<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h6 class="float-left">Companies</h6>
                    <div class="float-right">
                        <button class="btn btn-sm btn-default" @click="showFormModal('COMPANY_FORM')">
                            <span class="fa fa-plus"></span> Add Company
                        </button>
                    </div>
                </div>
                <div class="card-body p-2">
                    <companies-table></companies-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CompaniesTable from '../../tables/CompaniesTable';

    export default {
        created() {

        },
        computed: {
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_COMPANY').then(() => {
                    this.$store.dispatch('setForm', document.getElementById('companyForm'));
                    this.$store.dispatch('setModalTitle', "Company Details");
                    this.$store.dispatch('clearCompany');
                    this.$store.dispatch('showModal', this.currForm);
                });
            }
        },
        components: {
            CompaniesTable
        }
    }
</script>

<style>

</style>