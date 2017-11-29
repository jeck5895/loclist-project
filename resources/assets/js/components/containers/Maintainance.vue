<template>
    <div>
        <h4 class="py-2 mb-0">Form Keywords</h4>
        <hr class="mt-0">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h6 class="float-left">Industry</h6>
                        <div class="float-right">
                            <button class="btn btn-sm btn-default" @click="showFormModal('INDUSTRY_FORM')">
                                <span class="fa fa-plus"></span> Add Industry
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <industry-table></industry-table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header clearfix">
                        <h6 class="float-left">Nationality</h6>
                        <div class="float-right">
                            <button class="btn btn-sm btn-default" @click="showFormModal('NATIONALITY_FORM')">
                                <span class="fa fa-plus"></span> Add Nationality
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <nationalities-table></nationalities-table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h6 class="float-left">ISO Certicates</h6>
                        <div class="float-right">
                            <button class="btn btn-sm btn-default" @click="showFormModal('ISO_FORM')">
                                <span class="fa fa-plus"></span> Add Certificate
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <certificates-table></certificates-table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h6 class="float-left">Sourcing Practices</h6>
                        <div class="float-right">
                            <button class="btn btn-sm btn-default" @click="showFormModal('SOURCING_FORM')">
                                <span class="fa fa-plus"></span> Add Sourcing Practice
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <sourcing-table></sourcing-table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    import IndustryTable from '../tables/IndustryTable';
    import NationalitiesTable from '../tables/NationalitiesTable';
    import CertificatesTable from '../tables/CertificatesTable';
    import SourcingTable from '../tables/SourcingTable';

    export default {
        mounted(){

        },
        data() {
            return {

            };
        },
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods:{
            showFormModal(scope) {
                switch (scope) {
                    case 'INDUSTRY_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_INDUSTRY').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('industryForm'));
                            this.$store.dispatch('setModalTitle', "Industry Details");
                            this.$store.dispatch('clearIndustry');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'NATIONALITY_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_NATIONALITY').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('nationalityForm'));
                            this.$store.dispatch('setModalTitle', "Nationality Details");
                            this.$store.dispatch('clearNationality');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'ISO_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_ISO').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('isoForm'));
                            this.$store.dispatch('setModalTitle', "ISO Certificate Details");
                            this.$store.dispatch('clearCertificate');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    case 'SOURCING_FORM':
                        this.$store.dispatch('setModalFormType', 'CREATE_SOURCING_PRACTICE').then(()=>{
                            this.$store.dispatch('setForm', document.getElementById('sourcingForm'));
                            this.$store.dispatch('setModalTitle', "Sourcing Practice Details");
                            this.$store.dispatch('clearSourcingPractice');
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                    default:
                        break;
                }
            }
        },
        components:{
            IndustryTable,
            NationalitiesTable,
            CertificatesTable,
            SourcingTable
        } 
    }
</script>

<style>

</style>