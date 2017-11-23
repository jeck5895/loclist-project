<template>
    <div id="client-status" class="card card-default mt-1">
        <div class="card-header">
            <h5 class="mb-0 float-left">
                Acquisition
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
</template>

<script>
    export default {};
</script>

<style>

</style>