<template>
    <div class="col-md-12">
        <div class="card text-white bg-info mb-3 rounded-0">
            <div class="card-header p-2">
                <span class="h4">
                    <i class="fa fa-users"></i>
                </span> NO. OF CLIENTS ACQUIRED
                <div class="col-sm-4 float-right">
                    <select name="" id="" class="form-control form-control-sm">
                        <option v-for="(year, i) in  years" :key="i" :value="year.target_year">{{ year.target_year }}</option>
                    </select>
                </div>
            </div>
            <div class="card-body p-2 text-center">
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-2">
                            <small>Current</small>
                        </p>
                        <h3>90</h3>
                    </div>
                    <div class="col-sm-4">
                        <p class="mb-2">
                            <small>Target</small>
                        </p>
                        <h3>120</h3>
                    </div>
                    <div class="col-sm-4">
                        <p class="mb-2">
                            <small>Incomplete</small>
                        </p>
                        <h3>30</h3>
                    </div>
                </div>
            </div>
            <div class="card-footer clearfix">
                <div class="float-left">
                    Percentage:
                    <span class="h5">75%</span>
                </div>
                <div class="float-right">
                    Year:
                    <span class="h5">2018</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['years'],
    };
</script>

<style>
</style>