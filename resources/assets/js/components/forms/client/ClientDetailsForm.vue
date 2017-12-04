<template>
    <div id="client-details" class="card card-default">
        <div class="card-header clearfix">
            <h5 class="mb-0 float-left">
                Client Details
            </h5>
        </div>
        <div class="collapse show card-body" id="detailsCollapse">
            <!-- 1st row -->
            <form id="clientDetailsForm" @submit.prevent="submitDetailsForm('clientDetailsForm')" data-vv-scope="clientDetailsForm">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="companyName" class="control-label">Company Name
                            <span class="required-field">*</span>
                        </label>
                        <input v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm" name="company_name">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.company_name')">{{ errors.first('clientDetailsForm.company_name') }}</small>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">Industry
                            <span class="required-field">*</span>
                        </label>
                        <select v-validate="{rules:{required:true}}" name="client_industry" class="form-control form-control-sm" id="companyIndustry">
                            <option value="">--Select Industry--</option>
                            <option v-for="(industry, index) in industries" :key="index" :value="industry.id">
                                {{ industry.industry_name }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.client_industry')">{{ errors.first('clientDetailsForm.client_industry') }}</small>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">Nationality</label>
                        <select v-validate="{rules:{required:true}}" name="nationality" class="form-control form-control-sm">
                            <option value="">--Select Nationality--</option>
                            <option v-for="(nationality, index) in nationalities" :key="index" :value="nationality.id"> {{ nationality.nationality }}</option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.nationality')">{{ errors.first('clientDetailsForm.nationality') }}</small>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">ISO Certifacation</label>
                        <select v-validate="{rules:{required:true}}" name="client_isocertificate" class="form-control form-control-sm" id="companyIndustry">
                            <option value="">--Select Certificate--</option>
                            <option v-for="(certificate, index) in certificates" :key="index" :value="certificate.id">
                                {{ certificate.iso_name }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.client_isocertificate')">{{ errors.first('clientDetailsForm.client_isocertificate') }}</small>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="mailingAddress" class="control-label">Mailing Address</label>
                        <input v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm" name="mailing_address">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.mailing_address')">{{ errors.first('clientDetailsForm.mailing_address') }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Techno Park</label>
                        <input v-validate="{rules:{required:true}}" name="techno_park" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.techno_park')">{{ errors.first('clientDetailsForm.techno_park') }}</small>
                    </div>
                </div>

                <!-- 3rd row -->

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="streetAddress">Lot/Block No./Brgy/Town</label>
                        <input v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm" name="street_address">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.street_address')">{{ errors.first('clientDetailsForm.street_address') }}</small>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="streetAddress">City/Province</label>
                        <input v-validate="{rules:{required:true}}" @keypress="autoComplete" ref="address" type="text" name="province" id="" class="form-control form-control-sm" placeholder="Enter location">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.province')">{{ errors.first('clientDetailsForm.province') }}</small>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="companyIndustry">Area</label>
                        <input v-validate="{rules:{required:true}}" id="administrative_area_level_1" type="text" name="administrative_area_level_1" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.administrative_area_level_1')">{{ errors.first('clientDetailsForm.administrative_area_level_1') }}</small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="companyIndustry">Zip Code</label>
                        <input v-validate="{rules:{required:true}}" id="postal_code" name="postal_code"type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.postal_code')">{{ errors.first('clientDetailsForm.postal_code') }}</small>
                    </div>
                </div>

                <!-- 4th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Official Website</label>
                        <input type="url" name="company_website" class="form-control form-control-sm" placeholder="http://example.com">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.company_website')">{{ errors.first('clientDetailsForm.company_website') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Primary Landline</label>
                        <input v-validate="{rules:{required:true}}" name="primary_landline" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.primary_landline')">{{ errors.first('clientDetailsForm.primary_landline') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Other Landline</label>
                        <input v-validate="{rules:{required:true}}" name="other_landline" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.other_landline')">{{ errors.first('clientDetailsForm.other_landline') }}</small>
                    </div>
                </div>
                <!-- 5th row -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Contact Person</label>
                        <input v-validate="{rules:{required:true}}" name="contact_person" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.contact_person')">{{ errors.first('clientDetailsForm.contact_person') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Email</label>
                        <input v-validate="{rules:{required:true}}" name="email_address" type="email" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.email_address')">{{ errors.first('clientDetailsForm.email_address') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Mobile #</label>
                        <input v-validate="{rules:{required:true}}" name="mobile_number" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.mobile_number')">{{ errors.first('clientDetailsForm.mobile_number') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Department</label>
                        <select v-validate="{rules:{required:true}}" name="department" id="" class="form-control form-control-sm">
                            <option value="">--Select Department--</option>option>
                            <option v-for="(department, index) in departments" :key="index" :value="department.id">
                                {{ department.department_name }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.department')">{{ errors.first('clientDetailsForm.department') }}</small>
                    </div>
                </div>

                <!-- 6th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Gender</label>
                        <select v-validate="{rules:{required:true}}" name="gender" id="" class="form-control form-control-sm">
                            <option value="">--Select Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.gender')">{{ errors.first('clientDetailsForm.gender') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Position</label>
                        <select v-validate="{rules:{required:true}}" name="position" id="" class="form-control form-control-sm">
                            <option value="">--Select Position--</option>
                            <option v-for="(position, index) in positions" :key="index" :value="position.id">
                                {{ position.position_name }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.position')">{{ errors.first('clientDetailsForm.position') }}</small>
                    </div>
                </div>
                <!-- 7th row -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Manpower</label>
                        <select v-validate="{rules:{required:true}}" name="manpower_type" id="" class="form-control form-control-sm">
                            <option value="">--Select Manpower Type--</option>
                            <option v-for="(manpower, index) in manpowers" :key="index" :value="manpower.id">
                                {{ manpower.type }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.manpower_type')">{{ errors.first('clientDetailsForm.manpower_type') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Sourcing Practice</label>
                        <select v-validate="{rules:{required:true}}" name="sourcing_practice" id="" class="form-control form-control-sm">
                            <option value="">--Select Sourcing Practice--</option>
                            <option v-for="(sourcing_practice, index) in sourcing_practices" :key="index" :value="sourcing_practice.id">
                                {{ sourcing_practice.name }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.sourcing_practice')">{{ errors.first('clientDetailsForm.sourcing_practice') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Manpower Provider</label>
                        <input v-validate="{rules:{required:true}}" name="manpower_provider" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.manpower_provider')">{{ errors.first('clientDetailsForm.manpower_provider') }}</small>
                    </div>
                </div>

                <!-- 8th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Proposal</label>
                        <select v-validate="{rules:{required:true}}" name="proposal" id="" class="form-control form-control-sm">
                            <option value="">--Select Proposal--</option>
                            <option value="DIRECT">Direct</option>
                            <option value="OUTSOURCE">Outsourced</option>
                            <option value="LFC">LFC</option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.proposal')">{{ errors.first('clientDetailsForm.proposal') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Company (CSI/SRI)</label>
                        <select v-validate="{rules:{required:true}}" name="company"  class="form-control form-control-sm">
                            <option value="">--Select Company--</option>
                            <option v-for="(company, index) in companies" :key="index" :value="company.id">
                                {{ company.company_name }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.company')">{{ errors.first('clientDetailsForm.company') }}</small>
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
        this.$store.dispatch('loadDepartments','api/departments?type=all');
        this.$store.dispatch('loadPositions', 'api/positions?type=all');
        this.$store.dispatch('loadManpowers', 'api/manpowers?type=all');
        this.$store.dispatch('loadCompanies', 'api/companies?type=all');
    },
    data() {
        return {

        }
    },
    computed: {
        client() {
            return this.$store.getters.getClient;
        },
        companies() {
            return this.$store.getters.getCompanies;
        },
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
        },
        departments() {
            return this.$store.getters.getDepartments;
        },
        positions() {
            return this.$store.getters.getPositions;
        },
        manpowers() {
            return this.$store.getters.getManpowers;
        }
    },
    methods: {
        submitDetailsForm(scope) {
            let client = {
                client_name: this.client.client_name,
                industry: this.client.industry,
                nationality: this.client.nationality,
                iso_certf: this.client.iso_certf,
                complete_mailing_address: this.client.complete_mailing_address,
                techno_park: this.client.techno_park,
                street_address: this.client.street_address,
                province: this.client.province,
                administrative_area_level_1: this.client.administrative_area_level_1,
                postal_code: this.client.postal_code,
                website: this.client.website,
                primary_landline: this.client.primary_landline,
                other_landline: this.client.other_landline,
                mobile_number: this.client.mobile_number,
                email_address: this.client.email_address,
                contact_person: this.client.contact_person,
                gender: this.client.gender,
                department: this.client.department,
                position: this.client.position,
                proposal: this.client.proposal,
                company: this.client.company
                // manpower: this.client.manpower, this is seperate table
                // sourcing_practice: this.client.sourcing_practive this is seperate table,
                //manpower_provider: this.client.manpower_provider,

            };

            this.$validator.validateAll(scope).then((result) => {
                if (result) {
                   
                    if (this.formType == 'CREATE_CLIENT') {
                        // this.$store.dispatch('storeUser', user);
                        // this.$store.dispatch('loadUsers','/api/users');
                        toastr.success('Success', 'Client details has been saved');
                    }
                    else if (this.formType == 'EDIT_CLIENT') {
                        // this.$store.dispatch('updateUser', user);
                        // this.$store.dispatch('loadUsers','/api/users');
                    }
                    else {
                        toastr.error()
                    }
                }
                else {
                    console.log(result)
                    let payload = {
                        scope: scope,
                        errors: this.errors
                    };
                    this.$store.dispatch('setModalFormValidation', payload);
                }
            });
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

