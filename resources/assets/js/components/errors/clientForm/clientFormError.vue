<template>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 422">
                    <strong>Errors</strong> :{{ serverResponse.data.message }}
                    <ul v-if="serverResponse.data.errors">
                        <template v-if="serverResponse.data.errors.client_name">
                            <li v-for="e in serverResponse.data.errors.client_name" :key="e">{{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.industry">
                            <li v-for="e in serverResponse.data.errors.industry" :key="e">{{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.nationality">
                            <li v-for="e in serverResponse.data.errors.nationality" :key="e">{{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.iso_certf">
                            <li v-for="e in serverResponse.data.errors.iso_certf" :key="e">{{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.complete_mailing_address">
                            <li v-for="e in serverResponse.data.errors.complete_mailing_address" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.techno_park">
                            <li v-for="e in serverResponse.data.errors.techno_park" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.street_address">
                            <li v-for="e in serverResponse.data.errors.street_address" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.province">
                            <li v-for="e in serverResponse.data.errors.province" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.techno_park">
                            <li v-for="e in serverResponse.data.errors.techno_park" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.administrative_area_level_1">
                            <li v-for="e in serverResponse.data.errors.administrative_area_level_1" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.postal_code">
                            <li v-for="e in serverResponse.data.errors.postal_code" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.website">
                            <li v-for="e in serverResponse.data.errors.website" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.primary_landline">
                            <li v-for="e in serverResponse.data.errors.primary_landline" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.other_landline">
                            <li v-for="e in serverResponse.data.errors.other_landline" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.mobile_number">
                            <li v-for="e in serverResponse.data.errors.mobile_number" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.email_address">
                            <li v-for="e in serverResponse.data.errors.email_address" :key="e">{{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.contact_person">
                            <li v-for="e in serverResponse.data.errors.contact_person" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.gender">
                            <li v-for="e in serverResponse.data.errors.gender" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.department">
                            <li v-for="e in serverResponse.data.errors.department" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.position">
                            <li v-for="e in serverResponse.data.errors.position" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.proposal">
                            <li v-for="e in serverResponse.data.errors.proposal" :key="e"> {{ e }}</li>
                        </template>
                    </ul>
                </div>

                <div class="alert alert-danger" role="alert" v-if="serverResponse.status == 403">
                    <strong>You are not authorized to perform this action</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['serverResponse'],
    }
</script>

<style>

</style>