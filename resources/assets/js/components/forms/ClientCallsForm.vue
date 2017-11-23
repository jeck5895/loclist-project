<template>
    <div id="calls" class="card card-default mt-1">
        <div class="card-header clearfix">
            <h5 class="mb-0 float-left">
                Calls
            </h5>
            <h4>
                <a class="text-dark float-right" href="#callsCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="saturationCollapse">
                    <span class="fa fa-angle-down"></span>
                </a>
            </h4>
        </div>
        <div class="collapse card-body" id="callsCollapse">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="">Caller</label>
                    <input type="text" class="form-control">
                </div>
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
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="">Proposal was send?</label>
                    <select name="" id="" class="form-control">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-group col-md-9">
                    <label for="">Client Reponse</label>
                    <textarea name="" class="form-control" id="" cols="30" rows="1"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {};
</script>