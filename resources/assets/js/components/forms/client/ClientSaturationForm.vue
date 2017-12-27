<template>
    <form id="saturationForm" @submit.prevent="submitForm('saturationForm')" data-vv-scope="saturationForm">
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="">Date of Saturation</label>
                <input type="date" name="" id="" class="form-control form-control-sm">
            </div>
            <div class="form-group col-sm-12">
                <label for="">Mode of Saturation</label>
                <select name="" id="" class="form-control form-control-sm">
                    <option value="">--Select Mode of Saturation--</option>
                    <option value="Fax">Fax</option>
                    <option value="Personal">Personal</option>
                    <option value="Via-email">Via-email</option>
                </select>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Proposal made by</label>
                <input type="text" name="proposal_by" id="" class="form-control form-control-sm">
            </div>
            
            <div class="form-group col-sm-12">
                <label for="">Proposal Received & Accepted</label>
                <select name="" id="" class="form-control form-control-sm">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group col-sm-12">
                <label for="">Date Received</label>
                <input type="date" name="" id="" class="form-control form-control-sm">
            </div>
            <div class="form-group col-sm-12">
                <label for="">Manner of Confirmation</label>
                <select name="" id="" class="form-control form-control-sm">
                    <option value="">--Select Confirmation--</option>
                    <option value="Email">Email</option>
                    <option value="Personal">Personal</option>
                    <option value="Phone-call">Phone Call</option>
                </select>
            </div>
            
            <div class="form-group col-sm-12">
                <label for="">Follow Up Calls Made</label>
                <select name="" id="" class="form-control form-control-sm">
                    <option value=""></option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            
            <div class="form-group col-sm-12">
                <label for="">Date of Last FF Call</label>
                <input type="date" name="" id="" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-12">
                <label for="">Client Reponse</label>
                <textarea name="" id="" cols="30" rows="1" class="form-control form-control-sm"></textarea>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {

        },
        computed: {

        },
        methods: {
            submitForm(form) {
                alert();
            }
        }
    };
</script>