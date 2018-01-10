<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h6 class="float-left">Overall Status</h6>
                    <div class="float-right">
                        <button class="btn btn-sm btn-default" @click="showFormModal('STATUS_FORM')">
                            <span class="fa fa-plus"></span> Add Status
                        </button>
                    </div>
                </div>
                <div class="card-body p-2">
                    <status-table></status-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import StatusTable from '../../tables/StatusTable';

    export default {
        created() {
            this.$store.dispatch('setModalFormType', 'CREATE_STATUS');
        },
        computed: {
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods:{
            showFormModal(scope) {
                this.$store.dispatch('setForm', document.getElementById('statusForm'));
                this.$store.dispatch('setModalTitle', "Status Details");
                this.$store.dispatch('clearStatus');
                this.$store.dispatch('showModal', this.currForm);
            
            }
        },
        components:{
            StatusTable
        }
    }
</script>

<style>

</style>