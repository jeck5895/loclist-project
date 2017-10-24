<template>
    <div id="deleteConfirmationModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0"><slot name="confirmationHeader"></slot></h5>
                </div>
                <div class="modal-body">
                    <div class="clearfix">
                        <div class="form-group float-left">
                            <button @click="submitConfirmation" class="btn btn-sm btn-success" style="width:60px;">Yes</button>
                        </div>
                        <div class="form-group float-right">
                            <button @click="closeConfirmationModal" class="btn btn-sm btn-danger" style="width:60px;">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        created(){
            console.log(this.deletionType)
        },
        computed:{
            deletionType () {
                return this.$store.getters.getDeletionType;
            }
        },
        methods:{
            submitConfirmation () {
                var deletetionInfo = this.deletionType;
                this.$store.dispatch('deleteUser', deletetionInfo)
                .then(() => {
                    this.$store.dispatch('closeConfirmationModal');
                })
                .then(() => {
                    this.$store.dispatch('loadUsers','/api/users');
                });

                
            },
            closeConfirmationModal () {
                this.$store.dispatch('closeConfirmationModal');
            }
        }
    };
</script>
