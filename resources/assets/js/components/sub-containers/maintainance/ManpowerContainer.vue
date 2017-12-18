<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Manpower Types</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('MANPOWER_FORM')">
                    <span class="fa fa-plus"></span> Add Manpower
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <manpowers-table></manpowers-table>
        </div>
    </div>
</template>

<script>
import ManpowersTable from '../../tables/ManpowersTable';

export default {
    computed:{
        currForm(){
                return this.$store.getters.getForm;
            },
    },
    methods: {
        showFormModal(scope) {
            this.$store.dispatch('setModalFormType', 'CREATE_MANPOWER').then(() => {
                this.$store.dispatch('setForm', document.getElementById('manpowerForm'));
                this.$store.dispatch('setModalTitle', "Manpower Details");
                this.$store.dispatch('clearManpower');
                this.$store.dispatch('showModal', this.currForm);
            });
        }
    },
    components:{
        ManpowersTable
    }
}
</script>

<style>

</style>
