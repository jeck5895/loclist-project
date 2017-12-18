<template>
    <div class="card card-default">
        <div class="card-header">
            <h6 class="float-left">Departments</h6>
            <div class="float-right">
                <button class="btn btn-sm btn-default" @click="showFormModal('DEPARTMENT_FORM')">
                    <span class="fa fa-plus"></span> Add Departent
                </button>
            </div>
        </div>
        <div class="card-body p-2">
            <departments-table></departments-table>
        </div>
    </div>
</template>

<script>
    import DepartmentsTable from '../../tables/DepartmentsTable';
    export default {
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            },
        },
        methods: {
            showFormModal(scope) {
                this.$store.dispatch('setModalFormType', 'CREATE_DEPARTMENT').then(() => {
                    this.$store.dispatch('setForm', document.getElementById('departmentForm'));
                    this.$store.dispatch('setModalTitle', "Department Details");
                    this.$store.dispatch('clearDepartment');
                    this.$store.dispatch('showModal', this.currForm);
                });
            }
        },
        components: {
            DepartmentsTable
        }
    }
</script>

<style>

</style>
