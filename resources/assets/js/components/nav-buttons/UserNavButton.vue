<template>
    <button @click="showModal" class="btn btn-default btn-sm">
        <span class="fa fa-user-plus"></span>
        Add User
    </button>
</template>

<script>
    export default {
        computed: {
            currForm() {
                return this.$store.getters.getForm;
            }
        },
        methods: {
            showModal() {
                //this.$store.dispatch('clearUserTypes');
                this.$store.dispatch('setModalFormType', 'CREATE_USER').then(() => {
                    this.$store.dispatch('setModalTitle', "New User Details");
                    this.$store.dispatch('clearUser');
                    this.$store.dispatch('setForm', document.getElementById('userForm'));
                    this.$store.dispatch('showModal', this.currForm);
                });
            }
        }
    }
</script>