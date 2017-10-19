<template>
    <div class="row  justify-content-center">
        <div class="col-md-8" data-spy="scroll" data-target="#spy-form" data-offset="0">
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
                        <div class="form-group col-md-3">
                            <label for="">Fax Number</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <!-- 5th row -->
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
                        <div class="form-group col-md-3">
                            <label for="">Expiration of Contract</label>
                            <input type="date" class="form-control" name="" id="">
                        </div>
                    </div>

                    <!-- 8th row -->
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Date of Biding</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
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
                        <div class="form-group col-md-3">
                            <label for="">Caller</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <!-- 9th row -->
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Date of Call</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Confirmation Pre-Call</label>
                            <select name="" id="" class="form-control">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Productive Call</label>
                            <select name="" id="" class="form-control">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Proposal was send?</label>
                            <select name="" id="" class="form-control">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Client Reponse</label>
                            <textarea name="" class="form-control" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div id="client-saturation" class="card card-default mt-1">
                <div class="card-header clearfix">
                    <h5 class="mb-0 float-left">
                        Client Saturation
                    </h5>

                    <h4>
                        <a class="text-dark float-right" href="#saturationCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="saturationCollapse">
                            <span class="fa fa-angle-down"></span>
                        </a>
                    </h4>
                </div>
                <div class="collapse card-body" id="saturationCollapse">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Date of Saturation</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Mode of Saturation</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                                <option value="">Fax</option>
                                <option value="">Personal</option>
                                <option value="">Via-email</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Proposal by</label>
                            <input type="text" name="proposal_by" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Call Slip #</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Proposal Received & Accepted</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Date Received</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Manner of Confirmation</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                                <option value="">Email</option>
                                <option value="">Personal</option>
                                <option value="">Phone Call</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="">Follow Up Calls Made</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Date of Last FF Call</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Client Reponse</label>
                            <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Presentation -->
            <div id="client-presentation" class="card card-default mt-1">
                <div class="card-header clearfix">
                    <h5 class="mb-0 float-left">
                        Client Presentation
                    </h5>

                    <h4>
                        <a class="text-dark float-right" href="#presentationCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="presentationCollapse">
                            <span class="fa fa-angle-down"></span>
                        </a>
                    </h4>
                </div>
                <div class="collapse card-body" id="presentationCollapse">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Mode of Presentation</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                                <option value="call">Call</option>
                                <option value="personal">Personal</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Presentator</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                                <option value="call">Call</option>
                                <option value="personal">Personal</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Date of Presentation</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Call Slip</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Status per Presentation</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Date of follow-up meeting</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Action Plan</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Client Response</label>
                            <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div id="client-status" class="card card-default mt-1">
                <div class="card-header">
                    <h5 class="mb-0 float-left">
                        Client Status
                    </h5>

                    <h4>
                        <a class="text-dark float-right" href="#statusCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="statusCollapse">
                            <span class="fa fa-angle-down"></span>
                        </a>
                    </h4>
                </div>
                <div class="collapse card-body" id="statusCollapse">

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Status as of</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Date Acquired</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Acquired By</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Signed Contract if Applicable</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Manner of Acquisition</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Initial HC Acquired</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">If not owned, who referred? Or name of related client</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Last updated by</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Date of last update</label>
                            <input type="date" name="" id="" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Remarks</label>
                            <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <ul class="list-unstyled fixed-right" id="spy-form">
                <li><h6><a href="#client-details">Details</a></h6></li>
                <li><h6><a href="#client-saturation">Saturation</a></h6></li>
                <li><h6><a href="#client-presentation">Presentation</a></h6></li>
                <li><h6><a href="#client-status">Status</a></h6></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {

}   
</script>
