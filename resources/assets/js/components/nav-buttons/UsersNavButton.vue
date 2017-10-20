<template>
    <div class="row">
        <div class="col-md-12 mb-2 mt-2">
            <button @click="showModal" class="btn btn-default btn-sm">
                <span class="fa fa-user-plus"></span>
                Add User
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        computed:{
            currForm(){
                return this.$store.getters.getForm;
            }
        },
        methods:{
            showModal() {
                this.$store.dispatch('setModalTitle', "New User Details");
                this.$store.dispatch('setModalFormType', 'CreateUser');
                this.$store.dispatch('clearUser');
                this.$store.dispatch('setForm', document.getElementById('userForm'));
                this.$store.dispatch('showModal', this.currForm);
            }
        }
    }
</script>
