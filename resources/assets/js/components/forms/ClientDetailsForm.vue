<template>
    <div id="client-details" class="card card-default">
        <div class="card-header clearfix">
            <h5 class="mb-0 float-left">
                Client Details
            </h5>
            <h4>
                <a class="text-dark float-right" href="#detailsCollapse" data-toggle="collapse" aria-expanded="true" aria-controls="detailsCollapse">
                    <span class="fa fa-angle-down"></span>
                </a>
            </h4>
        </div>
        <div class="collapse show card-body" id="detailsCollapse">
            <!-- 1st row -->
            <form @submit.prevent="submitDetailsForm">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="companyName" class="control-label">Company Name
                            <span class="required-field">*</span>
                        </label>
                        <input type="text" class="form-control" id="companyName">

                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">Industry
                            <span class="required-field">*</span>
                        </label>
                        <select name="client_industry" class="form-control" id="companyIndustry">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">Nationality</label>
                        <select name="client_nationality" class="form-control" id="companyIndustry">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">ISO Certifacation</label>
                        <select name="client_isocertificate" class="form-control" id="companyIndustry">
                            <option></option>
                        </select>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="mailingAddress" class="control-label">Mailing Address</label>
                        <input type="text" class="form-control" id="mailingAddress">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Techno Park</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <!-- 3rd row -->

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="streetAddress">Lot/Block No./Brgy/Town</label>
                        <input type="text" class="form-control" id="streetAddress">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="streetAddress">City/Province</label>
                        <select name="province" id="" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="companyIndustry">Area</label>
                        <select name="area" class="form-control" id="companyIndustry">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="companyIndustry">Zip Code</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <!-- 4th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Official Website</label>
                        <input type="url" class="form-control" placeholder="http://example.com">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Primary Landline</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Other Landline</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <!-- 5th row -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Contact Person</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Mobile #</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Department</label>
                        <select name="" id="" class="form-control">
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <!-- 6th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Gender</label>
                        <select name="gender" id="" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Position</label>
                        <select name="position" id="" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <!-- 7th row -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Manpower</label>
                        <select name="" id="" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Sourcing Practice</label>
                        <select name="" id="" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Manpower Provider</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <!-- 8th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Proposal</label>
                        <select name="proposal" id="" class="form-control">
                            <option value="">Direct</option>
                            <option value="">Outsourced</option>
                            <option value="">LFC</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Company (CSI/SRI)</label>
                        <select name="" id="" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success" style="wid">Save Client Details</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    created() {

    },
    data() {
        return {

        }
    },
    methods: {
        submitDetailsForm(){
            alert('Form Submitted');
        }
    }
}
</script>
