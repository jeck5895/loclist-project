<template>
    <div class="row mt-5 justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="lead mb-0">EXPORT KPI ANALYSIS</h4>
                </div>
                <div class="card-body">
                    <form id="kpiAnalysisForm" @submit.prevent="generate('kpiAnalysisForm')" data-vv-scope="kpiAnalysisForm">
                        <div class="form-group">
                            <label for="report-year">Select year to export</label>
                            <select v-model="report_year" name="year" v-validate="'required'" id="report-year" class="form-control">
                                <option v-for="(year, i) in years" :key="i" :value="year.target_year">{{ year.target_year }}</option>
                            </select>
                            <small class="form-text has-danger" v-show="errors.has('kpiAnalysisForm.year')">{{ errors.first('kpiAnalysisForm.year') }}</small>
                        </div>
                        <!-- <div class="form-group">
                            <label for="from_date">Start Date</label>
                            <input name="from_date" v-model="from_date" v-validate="'required|date_format:YYYY-MM-DD'" type="date" class="form-control form-control-sm" id="from_date" placeholder="">
                            <small class="form-text has-danger" v-show="errors.has('kpiAnalysisForm.from_date')">{{ errors.first('kpiAnalysisForm.from_date') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="to_date">End Date</label>
                            <input name="to_date" v-model="to_date" v-validate="'required|date_format:YYYY-MM-DD|after:from_date,true'" type="date" class="form-control form-control-sm" id="to_date" placeholder="">
                            <small class="form-text has-danger" v-show="errors.has('kpiAnalysisForm.to_date')">{{ errors.first('kpiAnalysisForm.to_date') }}</small>
                        </div> -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm" :disabled="isSubmitting">
                                <span v-if="isSubmitting">
                                    Generating Report ...
                                    <div class="loading"></div>
                                </span>
                                <span v-else>
                                    Generate KPI Report
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                from_date: '',
                to_date: '',
                report_year: null
            }
        },
        computed: {
            isSubmitting() {
                return this.$store.getters.getSubmitState;
            },
            years() {
                return this.$store.getters.getTargetListYears;
            }
            // years: function () {
            //     let years = [];

            //     for (let current_year = new Date().getFullYear(); current_year >= 2000; current_year--) {
            //         years.push(current_year);
            //     }

            //     return years;
            // }
        },
        methods: {
            generate(scope) {
                let payload = {
                    report_year: this.report_year
                };

                var self = this;

                this.$validator.validateAll(scope).then((result) => {
                    if(result) {
                        //window.open(axios.defaults.baseURL + "/api/reports/kpi-analysis/export/from_date/" + payload.from_date + "/to_date/" + payload.to_date);
                        self.$store.commit('setSubmitState', true);
                        var anchor_tag = document.createElement("a");
                        anchor_tag.style = "display:none";

                        axios.post("api/reports/kpi-analysis/export", payload) 
                        .then(response => {
                           console.log(response);
                            self.$store.commit('setSubmitState', false);
                            anchor_tag.href = response.data.file;
                            anchor_tag.target = "_blank"
                            anchor_tag.download = response.data.filename;
                            anchor_tag.click();
                           //window.URL.revokeObjectURL(download_link);
                        })
                        .catch(error => {
                            self.$store.commit('setSubmitState', false);
                            console.log(error)
                        });
                    }
                    else{
                        console.log(this.errors)
                    }
                });
            }
        }
    }
</script>

<style>
</style>