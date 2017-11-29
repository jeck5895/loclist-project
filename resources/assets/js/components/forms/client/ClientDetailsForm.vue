<template>
    <div id="client-details" class="card card-default">
        <div class="card-header clearfix">
            <h5 class="mb-0 float-left">
                Client Details
            </h5>
            <!-- <h4>
                <a class="text-dark float-right" href="#detailsCollapse" data-toggle="collapse" aria-expanded="true" aria-controls="detailsCollapse">
                    <span class="fa fa-angle-down"></span>
                </a>
            </h4> -->
        </div>
        <div class="collapse show card-body" id="detailsCollapse">
            <!-- 1st row -->
            <form id="clientDetailsForm" @submit.prevent="submitDetailsForm('clientDetailsForm')" data-vv-scope="clientDetailsForm">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="companyName" class="control-label">Company Name
                            <span class="required-field">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm" id="companyName">

                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">Industry
                            <span class="required-field">*</span>
                        </label>
                        <select name="client_industry" class="form-control form-control-sm" id="companyIndustry">
                            <option>--Select Industry--</option>
                            <option v-for="(industry, index) in industries" :key="index" :value="industry.id">
                                {{ industry.industry_name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">Nationality</label>
                        <select v-validate="{rules:{required:true}}" name="nationality" class="form-control form-control-sm">
                            <option>--Select Nationality--</option>
                            <option v-for="(nationality, index) in nationalities" :key="index" :value="nationality.id"> {{ nationality.nationality }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">ISO Certifacation</label>
                        <select name="client_isocertificate" class="form-control form-control-sm" id="companyIndustry">
                            <option>--Select Certificate--</option>
                            <option v-for="(certificate, index) in certificates" :key="index" :value="certificate.id">
                                {{ certificate.iso_name }}
                            </option>
                        </select>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="mailingAddress" class="control-label">Mailing Address</label>
                        <input type="text" class="form-control form-control-sm" id="mailingAddress">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Techno Park</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                </div>

                <!-- 3rd row -->

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="streetAddress">Lot/Block No./Brgy/Town</label>
                        <input type="text" class="form-control form-control-sm" id="streetAddress">
                    </div>

                    <div class="form-group col-md-5">
                        <label for="streetAddress">City/Province</label>
                        <input @keypress="autoComplete" ref="address" type="text" name="province" id="" class="form-control form-control-sm" placeholder="Enter location">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="companyIndustry">Area</label>
                        <!-- <select name="area" class="form-control form-control-sm" id="companyIndustry">
                            <option></option>
                        </select> -->
                        <input id="administrative_area_level_1" type="text" name="administrative_area_level_1" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="companyIndustry">Zip Code</label>
                        <input id="postal_code" name="postal_code"type="text" class="form-control form-control-sm">
                    </div>
                </div>

                <!-- 4th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Official Website</label>
                        <input type="url" class="form-control form-control-sm" placeholder="http://example.com">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Primary Landline</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Other Landline</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                </div>
                <!-- 5th row -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Contact Person</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Mobile #</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Department</label>
                        <select name="" id="" class="form-control form-control-sm">
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <!-- 6th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Gender</label>
                        <select name="gender" id="" class="form-control form-control-sm">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Position</label>
                        <select name="position" id="" class="form-control form-control-sm">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <!-- 7th row -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Manpower</label>
                        <select name="" id="" class="form-control form-control-sm">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Sourcing Practice</label>
                        <select name="sourcing_practice" id="" class="form-control form-control-sm">
                            <option>--Select Sourcing Practice--</option>
                            <option v-for="(sourcing_practice, index) in sourcing_practices" :key="index" :value="sourcing_practice.id">
                                {{ sourcing_practice.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Manpower Provider</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                </div>

                <!-- 8th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Proposal</label>
                        <select name="proposal" id="" class="form-control form-control-sm">
                            <option value="">Direct</option>
                            <option value="">Outsourced</option>
                            <option value="">LFC</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Company (CSI/SRI)</label>
                        <select name="" id="" class="form-control form-control-sm">
                            <option value="">--Select Company--</option>
                            <option value="CSI">CSI</option>
                            <option value="SRI">SRI</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success btn-sm" style="wid">Save Client Details</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.$store.dispatch('loadNationalities','api/nationalities?type=all');
        this.$store.dispatch('loadCertificates','api/certificates?type=all');
        this.$store.dispatch('loadIndustries','api/industries?type=all');
        this.$store.dispatch('loadSourcingPractices','api/sourcing_practices?type=all');
    },
    data() {
        return {

        }
    },
    computed: {
        industries() {
            return this.$store.getters.getIndustries;
        },
        nationalities() {
            return this.$store.getters.getNationalities;
        },
        certificates() {
            return this.$store.getters.getIsoCertificates;
        },
        sourcing_practices() {
            return this.$store.getters.getSourcingPratices;
        }
    },
    methods: {
        submitDetailsForm() {

        },
        autoComplete() {
            var refs = this.$refs;
            var input = refs.address;
            var autocomplete = new google.maps.places.Autocomplete(input);
            // var autocomplete = new google.maps.places.Autocomplete(input,{types:['(regions)']});
            autocomplete.addListener('place_changed', () => {
                console.log(autocomplete.getPlace());
                var place = autocomplete.getPlace();
                var componentForm = {
                    street_number: 'short_name',
                    route: 'long_name',
                    locality: 'long_name',
                    administrative_area_level_1: 'short_name',
                    country: 'long_name',
                    postal_code: 'short_name'
                };
                
                for(var element in componentForm){
                    if(document.getElementById(element))
                        document.getElementById(element).value = ''; //reset value
                }

                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    
                    if (componentForm[addressType]) {
                        var val = place.address_components[i][componentForm[addressType]];
                        
                        if(document.getElementById(addressType)){
                            document.getElementById(addressType).value = val;
                        }
                    }
                }
            });
        }
    }
}
</script>

