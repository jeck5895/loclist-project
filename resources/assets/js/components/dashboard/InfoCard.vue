<template>
    <div class="col-md-12">
        <div class="card mb-3 rounded-0">
            <div class="card-header p-2">
                <span class="h4">
                    <i :class="icon"></i>
                </span>&nbsp;{{ title.toUpperCase() }}
            </div>
            <div class="card-body p-2 text-center">
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-2">
                            <small>Current</small>
                        </p>
                        <h3 v-if="!isLoading">{{ currentValue != null ? currentValue : 0 }}</h3>
                        <span v-else>
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                        </span>
                    </div>
                    <div class="col-sm-4">
                        <p class="mb-2">
                            <small>Target</small>
                        </p>
                        <h3 v-if="!isLoading">{{ targetValue }}</h3>
                        <span v-else>
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                        </span>
                    </div>
                    <div class="col-sm-4">
                        <p class="mb-2">
                            <small>Incomplete</small>
                        </p>
                        <h3 v-if="!isLoading">{{ incomplete }}</h3>
                        <span v-else>
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-footer clearfix py-1">
                <div class="float-left">
                    <small>Percentage:</small>
                    <span v-if="!isLoading" class="h5">{{ percentage }}%</span>
                    <span v-else>
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                </div>
                <div class="float-right">
                    <small>Status:</small>
                    <span v-if="!isLoading" :class="status == 'UNMET' ? 'text-danger h5' : 'text-sucess h5'">{{ status }}</span>
                    <span v-else>
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['icon','title', 'currentValue', 'targetValue', 'isLoading'],
        data() {
            return {
                // status: this.currentValue >= this.targetValue ? "MET" : "UNMET",
                // incomplete: parseInt(this.currentValue) >= parseInt(this.targetValue) ? 0 : parseInt(this.targetValue) - parseInt(this.currentValue),
                // percentage: (parseFloat(this.currentValue) / parseFloat(this.targetValue)) * 100,
            }
        },
        computed: {
            incomplete() {
                if(!this.isLoading) 
                {
                    if(this.currentValue == null) {
                        return this.targetValue;
                    }
                    else if(parseInt(this.currentValue) >= parseInt(this.targetValue)){
                        return 0;
                    }
                    else {
                        return parseInt(this.targetValue) - parseInt(this.currentValue);
                    }
                }
            },
            percentage() {
                if(!this.isLoading){
                    return this.currentValue != null ?  (parseFloat(this.currentValue) / parseFloat(this.targetValue)) * 100 : 0;
                }
            },
            status() {
                if(!this.isLoading){
                    return this.currentValue >= this.targetValue ? "MET" : "UNMET";
                }
            }
        },
        created() {
            
        }
    };
</script>

<style>
</style>