<template>
    <div id="client-presentation" class="card card-default mt-1">
        <div class="card-header clearfix">
            <h5 class="mb-0 float-left">
                Presentation
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
                    <label for="">Presentor</label>
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
</template>

<script>
    export default {

    }
</script>

<style>

</style>