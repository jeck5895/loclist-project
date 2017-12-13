<template>
    <div id="client-details" class="card card-default">
        <div class="card-header clearfix">
            <h5 class="mb-0 float-left">
                Client Details
            </h5>
        </div>
        <div v-if="isLoading" class="card-body">
            <div class="row">
                <div class="img-loading-container">
                    <img src="/images/spinner.gif">
                </div>   
            </div>
        </div>
        <div v-else class="collapse show card-body" id="detailsCollapse">
            <form id="clientDetailsForm" @submit.prevent="submitDetailsForm('clientDetailsForm')" data-vv-scope="clientDetailsForm">
                <form-errors :serverResponse="serverResponse"></form-errors>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="companyName" class="control-label">Company Name
                            <span class="required-field">*</span>
                        </label>
                        <input v-model="client.client_name" v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm" name="company_name" style="text-transform: uppercase;">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.company_name')">{{ errors.first('clientDetailsForm.company_name') }}</small>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">Industry
                            <span class="required-field">*</span>
                        </label>
                        <select v-model="client.industry" v-validate="{rules:{required:true}}" name="client_industry" class="form-control form-control-sm" id="companyIndustry">
                            <option :value="null">--Select Industry--</option>
                            <option v-for="(industry, index) in industries" :key="index" :value="industry.id">
                                {{ industry.industry_name }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.client_industry')">{{ errors.first('clientDetailsForm.client_industry') }}</small>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">Nationality</label>
                        <select v-model="client.nationality" v-validate="{rules:{required:true}}" name="nationality" class="form-control form-control-sm">
                            <option value="">--Select Nationality--</option>
                            <option v-for="(nationality, index) in nationalities" :key="index" :value="nationality.id"> {{ nationality.nationality }}</option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.nationality')">{{ errors.first('clientDetailsForm.nationality') }}</small>
                    </div>
                    <div class="col-md-3">
                        <label for="companyIndustry">ISO Certifacation</label>
                        <select v-model="client.iso_certf" v-validate="{rules:{required:true}}" name="client_isocertificate" class="form-control form-control-sm" id="companyIndustry">
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
                        <input v-model="client.complete_mailing_address" v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm" name="mailing_address">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.mailing_address')">{{ errors.first('clientDetailsForm.mailing_address') }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Techno Park</label>
                        <input v-model="client.techno_park" v-validate="{rules:{required:true}}" name="techno_park" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.techno_park')">{{ errors.first('clientDetailsForm.techno_park') }}</small>
                    </div>
                </div>

                <!-- 3rd row -->

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="streetAddress">Lot/Block No./Brgy/Town</label>
                        <input v-model="client.street_address" v-validate="{rules:{required:true}}" type="text" class="form-control form-control-sm" name="street_number">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.street_address')">{{ errors.first('clientDetailsForm.street_address') }}</small>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="streetAddress">City/Province</label>
                        <input v-model="client.province" v-validate="{rules:{required:true}}" @keypress="autoComplete" ref="address" type="text" name="province" id="province" class="form-control form-control-sm" placeholder="Enter location">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.province')">{{ errors.first('clientDetailsForm.province') }}</small>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="companyIndustry">Area</label>
                        <input v-model="client.administrative_area_level_1" v-validate="{rules:{required:true}}" id="administrative_area_level_1" type="text" name="administrative_area_level_1" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.administrative_area_level_1')">{{ errors.first('clientDetailsForm.administrative_area_level_1') }}</small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="companyIndustry">Zip Code</label>
                        <input v-model="client.postal_code" v-validate="{rules:{required:true}}" id="postal_code" name="postal_code"type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.postal_code')">{{ errors.first('clientDetailsForm.postal_code') }}</small>
                    </div>
                </div>

                <!-- 4th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Official Website</label>
                        <input v-model="client.website" type="text"  v-validate="'required'" name="company_website" class="form-control form-control-sm" placeholder="http://example.com">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.company_website')">{{ errors.first('clientDetailsForm.company_website') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Primary Landline</label>
                        <input v-model="client.primary_landline" v-validate="{rules:{required:true}}" name="primary_landline" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.primary_landline')">{{ errors.first('clientDetailsForm.primary_landline') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Other Landline</label>
                        <input v-model="client.other_landline" v-validate="{rules:{required:true}}" name="other_landline" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.other_landline')">{{ errors.first('clientDetailsForm.other_landline') }}</small>
                    </div>
                </div>
                <!-- 5th row -->
                <hr>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Contact Person</label>
                        <input v-model="client.contact_person" v-validate="{rules:{required:true}}" name="contact_person" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.contact_person')">{{ errors.first('clientDetailsForm.contact_person') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Email</label>
                        <input v-model="client.email_address" v-validate="{rules:{required:true, email: true}}" name="email_address" type="email" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.email_address')">{{ errors.first('clientDetailsForm.email_address') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Mobile #</label>
                        <input v-model="client.mobile_number" v-validate="{rules:{required:true}}" name="mobile_number" type="text" class="form-control form-control-sm">
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.mobile_number')">{{ errors.first('clientDetailsForm.mobile_number') }}</small>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="">Gender</label>
                        <select v-model="client.gender" v-validate="{rules:{required:true}}" name="gender" id="" class="form-control form-control-sm">
                            <option value="">--Select Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.gender')">{{ errors.first('clientDetailsForm.gender') }}</small>
                    </div>
                </div>

                <!-- 6th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Department</label>
                        <select v-model="client.department" v-validate="{rules:{required:true}}" name="department" id="" class="form-control form-control-sm">
                            <option value="">--Select Department--</option>option>
                            <option v-for="(department, index) in departments" :key="index" :value="department.id">
                                {{ department.department_name }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.department')">{{ errors.first('clientDetailsForm.department') }}</small>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="">Position</label>
                        <select v-model="client.position" v-validate="{rules:{required:true}}" name="position" id="" class="form-control form-control-sm">
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
                <!-- 8th row -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">Proposal</label>
                        <select v-model="client.proposal" v-validate="{rules:{required:true}}" name="proposal" id="" class="form-control form-control-sm">
                            <option value="">--Select Proposal--</option>
                            <option value="DIRECT">DIRECT</option>
                            <option value="OUTSOURCE">OUTSOURCED</option>
                            <option value="LFC">LFC</option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.proposal')">{{ errors.first('clientDetailsForm.proposal') }}</small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Company (CSI/SRI)</label>
                        <select v-model="client.company" v-validate="{rules:{required:true}}" name="company"  class="form-control form-control-sm">
                            <option value="">--Select Company--</option>
                            <option v-for="(company, index) in companies" :key="index" :value="company.id">
                                {{ company.company_name.toUpperCase() }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.company')">{{ errors.first('clientDetailsForm.company') }}</small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Manpower</label>
                        <select v-model="client.manpower" v-validate="{rules:{required:true}}" name="manpower_type" id="" class="form-control form-control-sm">
                            <option value="">--Select Manpower Type--</option>
                            <option v-for="(manpower, index) in manpowers" :key="index" :value="manpower.id">
                                {{ manpower.type }}
                            </option>
                        </select>
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.manpower_type')">{{ errors.first('clientDetailsForm.manpower_type') }}</small>
                    </div> 
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        
                        <label for="">Sourcing Practice</label>
                        <select2-multiple :options="options" v-model="selected">
                            <option disabled value="0">--Select Practices--</option>
                        </select2-multiple>
                        
                        <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.sourcing_practice')">{{ errors.first('clientDetailsForm.sourcing_practice') }}</small>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label for="">Manpower Provider</label>
                        <div class="input-group">
                            <input  v-model="client_manpower_provider.manpower_provider" 
                                    ref="manpower_provider_field"
                                    name="client_manpower_provider" 
                                    type="text" 
                                    class="form-control form-control-sm"
                                    placeholder="Add manpower provider here...">
                            <button @click.prevent="addProvider" class="btn btn-default btn-sm ml-1">Add Provider</button>
                        </div>
                        <!-- <small class="form-text has-danger" v-show="errors.has('clientDetailsForm.manpower_provider')">{{ errors.first('clientDetailsForm.manpower_provider') }}</small> -->
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:80%;">Provider</th>
                                    <th scope="col" style="width:20%;">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="client_manpower_providers == 0">
                                    <td colspan="11" class="text-center">
                                        No providers to show...
                                    </td>
                                </tr>
                                <tr v-else v-for="(m, index) in client_manpower_providers" :key="index">
                                    <td style="vertical-align: middle;">
                                        {{ m.manpower_provider }}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button @click="removeProvider(m)" class="btn btn-sm btn-danger">
                                            <span class="fa fa-times-circle"></span>
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success btn-sm" :disabled="isSubmitting">
                            <span v-if="isSubmitting" >
                                Saving...  <span class="fa fa-refresh fa-spin"></span>
                            </span>
                            <span v-else>
                                Save Client Details
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


<script>
import formErrors from '../../errors/clientForm/clientFormError';

export default {
    created() {
        
    },
    data() {
        return {
            selected: []
        }
    },
    computed: {
        isSubmitting() {
            return this.$store.getters.getSubmitState;
        },
        isLoading() {
            return this.$store.getters.getLoadingState;
        },
        client() {
            return this.$store.getters.getClient;
        },
        client_manpower_providers() {
            return this.$store.getters.getClientManpowerProviders;
        },
        client_manpower_provider() {
            return this.$store.getters.getClientManpowerProvider;
        },
        client_sourcing_practices() {
            return this.$store.getters.getClientSourcingPractices;
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
        },
        formType() {
            return localStorage.getItem('f_type');
        },
        serverResponse() {
            return this.$store.getters.getServerResponse;
        },
        options() {
            var sp = this.sourcing_practices;
            var op = [];
            
            $.each(sp, (index, item) => {
                var obj = {
                        id: item.id,
                        text: item.name
                    }
                op.push(obj);
            });

            return op;
        },
        // selected() {
        //     //array of id's of selected sourcing practices e.g. return [1,2,3] - use push to insert
        // }
    },
    methods: {
        addProvider() {
            let provider = {
                id: this.client_manpower_provider.id,
                client_id: this.client_manpower_provider.client_id,
                manpower_provider: this.client_manpower_provider.manpower_provider
            };

            if(!this.client_manpower_provider.manpower_provider == ''){
                this.$store.dispatch('storeClientManpowerProviders', provider)
                .then(() => {
                    this.$refs.manpower_provider_field.value = '';
                    this.client_manpower_provider.manpower_provider = '';
                });
            }
        },
        removeProvider(provider){
            this.$store.dispatch('removeClientManpowerProvider', provider)
            .then(() => {
                this.$refs.manpower_provider_field.value = '';
            });
        },
        submitDetailsForm(scope) {
            let user = Vue.auth.getter();
           
            this.$validator.validateAll(scope).then((result) => {
                if (result) {
                    let client = {
                        entry_by: user.uid,
                        client_name: this.client.client_name.toUpperCase(),
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
                        company: this.client.company,
                        manpower: this.client.manpower,
                        sourcing_practices: this.selected,
                        manpower_providers: this.client_manpower_providers,
                    };
                   
                    if (this.formType == 'CREATE_CLIENT') {
                        this.$store.dispatch('storeClient', client)
                        .then(response => {
                            console.log(response)
                            //document.getElementById('clientDetailsForm').reset();
                            this.$store.dispatch('clearClient');
                            this.$store.dispatch('clearClientManpowerProviders');
                            this.selected = [];
                        })
                        .catch(error => {
                            console.log(error)
                        });
                       
                    }
                    else if (this.formType == 'EDIT_CLIENT') {
                        // this.$store.dispatch('updateUser', user);
                        // this.$store.dispatch('loadUsers','/api/users');
                    }
                    else {
                        toastr.error('Error', 'Invalid Operation');
                    }
                }
                else {
                    toastr.error('Warning', 'Please fix errors to submit');
                    console.log(result)
                    console.log(this.errors)
                    let payload = {
                        scope: scope,
                        errors: this.errors
                    };
                    //this.$store.dispatch('setModalFormValidation', payload);
                }
            });
        },
        autoComplete() {
            var self = this;
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
                            this.client[addressType] = val;
                            this.client.province = input.value;
                        }
                    }
                }
            });
        }
    },
    components: {
        formErrors
    }
}

</script>


<style>
    .btn-danger{
        background-color: #BD362F !important;
        border-color: #BD362F !important;
    }
    .select2.select2-container.select2-container--default{
        width:100%!important;
    }
    .select2-container--default .select2-selection--multiple {
        padding: 0 0.5rem;
        border-radius: 0!important;
        border: 1px solid rgba(0, 0, 0, 0.15)!important;
        min-height: 28.38px !important;
    }

    .select2-container .select2-search--inline .select2-search__field{
        font-size: 85% !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #ffc107;
        color: antiquewhite;
    }
</style>


