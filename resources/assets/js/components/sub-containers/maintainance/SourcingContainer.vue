<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Sourcing Practices</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('SOURCING_FORM')">
                    <span class="fa fa-plus"></span> Add Sourcing Practice
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <sourcing-table></sourcing-table>
        </div>
    </div>
</template>

<script>
    import SourcingTable from '../../tables/SourcingTable';
    export default {
        beforeCreate(){
            this.$store.dispatch('setModalFormType', 'CREATE_SOURCING_PRACTICE');
        },
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_SOURCING_PRACTICE');
                this.$store.dispatch('setForm', document.getElementById('sourcingForm'));
                this.$store.dispatch('setModalTitle', "Sourcing Practice Details");
                this.$store.dispatch('clearSourcingPractice');
                this.$store.dispatch('showModal', this.currForm);
            }
        },
        components: {
            SourcingTable
        }
    }
</script>

<style>

</style>
