<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">ISO Certicates</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('ISO_FORM')">
                    <span class="fa fa-plus"></span> Add Certificate
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <certificates-table></certificates-table>
        </div>
    </div>
</template>

<script>
    import CertificatesTable from '../../tables/CertificatesTable';

    export default {
        beforeCreate(){
            this.$store.dispatch('setModalFormType', 'CREATE_ISO');
        },
        computed: {
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope){
                this.$store.dispatch('setForm', document.getElementById('isoForm'));
                this.$store.dispatch('setModalTitle', "ISO Certificate Details");
                this.$store.dispatch('clearIsoCertificate');
                this.$store.dispatch('showModal', this.currForm);
            }
        },
        components:{
            CertificatesTable
        }
    }
</script>

<style>

</style>
