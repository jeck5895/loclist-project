<template>
    <div class="modal fade show" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <slot name="header"></slot>
                    </h5>
                    <button type="button" class="close" @click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
                        <button type="submit" @click="submitUserForm($event)" class="btn btn-primary">Save changes</button>
                    </div> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        formType() {
            return this.$store.getters.getModalFormType;
        },
        user() {
            return this.$store.getters.loadUser;
        },
        modalFormValidation() {
            return this.$store.getters.getModalFormValidation;
        },
    },
    methods: {
        closeModal() {
            //dispatch the closeModal event from the store which resets/clear form errors
            this.$store.dispatch('closeModal', this.modalFormValidation);
        },
    }
}
</script>
