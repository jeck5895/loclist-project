<template>
    <form id="callForm" @submit.prevent="submitForm('callForm')" data-vv-scope="callForm">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="">Caller</label>
                <input type="text" class="form-control form-control-sm">
            </div>

            <div class="form-group col-sm-12">
                <label for="">Date of Call</label>
                <input type="date" name="" id="" class="form-control form-control-sm">
            </div>
            
            <div class="form-group col-sm-12">
                <label for="">Confirmation Pre-Call</label>
                <select name="" id="" class="form-control form-control-sm">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Productive Call</label>
                <select name="" id="" class="form-control form-control-sm">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Proposal was send?</label>
                <select name="" id="" class="form-control form-control-sm">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Client Reponse</label>
                <textarea name="" class="form-control form-control-sm" id="" cols="30" rows="1"></textarea>
            </div>

            <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                <button type="button" @click="closeModal('userForm')" class="btn btn-sm btn-danger">
                    Close
                </button>
            </div>
        </div>
    </form>

</template>

<script>
export default {
  mounted() {},
  computed: {
        modalFormValidation() {
            return this.$store.getters.getModalFormValidation;
        },
  },
  methods: {
    submitForm(form) {
      alert();
    },
    closeModal(scope) {
      let payload = {
        scope: scope,
        errors: this.errors
      };
      this.$store.dispatch("setModalFormValidation", payload);
      this.$store.dispatch("closeModal", this.modalFormValidation);
    }
  }
};
</script>