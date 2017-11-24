<template>
    <div>
        <h4 class="py-2">Form Keywords</h4>
        <hr class="">
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
                            <button class="btn btn-sm btn-default">
                                <span class="fa fa-plus"></span> Add Nationality
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>

        
    </div>
</template>

<script>
    import IndustryTable from '../tables/IndustryTable';
   
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
                            this.$store.dispatch('showModal', this.currForm);
                        });
                        break;
                
                    default:
                        break;
                }
            }
        },
        components:{
            IndustryTable
        }
    }
</script>

<style>

</style>