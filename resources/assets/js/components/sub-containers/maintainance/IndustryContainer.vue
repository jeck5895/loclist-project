<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Industries</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('INDUSTRY_FORM')">
                    <span class="fa fa-plus"></span> Add Industry
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <industry-table></industry-table>
        </div>
    </div>
</template>

<script>
    import IndustryTable from '../../tables/IndustryTable';

    export default {
        beforeCreate(){
            this.$store.dispatch('setModalFormType', 'CREATE_INDUSTRY');
        },
        created() {

        },
        computed: {
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setForm', document.getElementById('industryForm'));
                this.$store.dispatch('setModalTitle', "Industry Details");
                this.$store.dispatch('clearIndustry');
                this.$store.dispatch('showModal', this.currForm);
            }
        },
        components: {
            IndustryTable
        }
    }
</script>

<style>

</style>