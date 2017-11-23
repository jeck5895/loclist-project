<template>
    <div id="client-saturation" class="card card-default mt-1">
        <div class="card-header clearfix">
            <h5 class="mb-0 float-left">
                Saturation
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
</template>

<script>
    export default {
    
    }
</script>
