<template>
    <div class="card card-default">
        <div class="card-header clearfix">
            <h6 class="float-left">Nationalities</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('NATIONALITY_FORM')">
                    <span class="fa fa-plus"></span> Add Nationality
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <nationalities-table></nationalities-table>
        </div>
    </div>
</template>

<script>
    import NationalitiesTable from '../../tables/NationalitiesTable';
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
                this.$store.dispatch('setModalFormType', 'CREATE_NATIONALITY').then(() => {
                    this.$store.dispatch('setForm', document.getElementById('nationalityForm'));
                    this.$store.dispatch('setModalTitle', "Nationality Details");
                    this.$store.dispatch('clearNationality');
                    this.$store.dispatch('showModal', this.currForm);
                });
            }
        },
        components: {
            NationalitiesTable
        }
    }
</script>

<style>

</style>