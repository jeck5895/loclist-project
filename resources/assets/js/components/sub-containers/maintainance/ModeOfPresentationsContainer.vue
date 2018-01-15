<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Mode of Presentations</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('MODE_OF_PRESENTATION_FORM')">
                    <span class="fa fa-plus"></span> Add Keyword
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <mode-of-presentation-table></mode-of-presentation-table>
        </div>
    </div>
</template>

<script>
    import ModeOfPresentationTable from '../../tables/maintainance/ModeOfPresentationTable';

    export default {
        beforeCreate(){
            this.$store.dispatch('setModalFormType', 'CREATE_MODE_OF_PRESENTATION');
        },
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_MODE_OF_PRESENTATION');
                this.$store.dispatch('setForm', document.getElementById('modeOfPresentationForm'));
                this.$store.dispatch('setModalTitle', "Mode of Presentation Details");
                this.$store.dispatch('clearModeOfPresentation');
                this.$store.dispatch('showModal', this.currForm);
            }
        },
        components: {
            ModeOfPresentationTable
        }
    }
</script>

<style>

</style>
