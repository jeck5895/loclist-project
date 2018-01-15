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
                        <!-- Client Call form errors-->
                        <template v-if="serverResponse.data.errors.caller">
                            <li v-for="e in serverResponse.data.errors.caller" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.company">
                            <li v-for="e in serverResponse.data.errors.company" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.date_of_call">
                            <li v-for="e in serverResponse.data.errors.date_of_call" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.confirmation_preCall">
                            <li v-for="e in serverResponse.data.errors.confirmation_preCall" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.productive_call">
                            <li v-for="e in serverResponse.data.errors.productive_call" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.proposal_sent">
                            <li v-for="e in serverResponse.data.errors.proposal_sent" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.client_response">
                            <li v-for="e in serverResponse.data.errors.client_response" :key="e"> {{ e }}</li>
                        </template>
                        <template v-if="serverResponse.data.errors.client_id">
                            <li v-for="e in serverResponse.data.errors.client_id" :key="e"> {{ e }}</li>
                        </template>

                        <!-- Client Saturation Error -->
                        <template v-if="serverResponse.data.errors.proposal_by">
                            <li v-for="e in serverResponse.data.errors.proposal_by" :key="e"> {{ e }}</li>
                        </template>

                        <!-- Already declared in client calls  (same name so doesn't need to declare again)
                        <template v-if="serverResponse.data.errors.company">
                            <li v-for="e in serverResponse.data.errors.company" :key="e"> {{ e }}</li>
                        </template> -->

                        <template v-if="serverResponse.data.errors.saturation_date">
                            <li v-for="e in serverResponse.data.errors.saturation_date" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.saturation_mode">
                            <li v-for="e in serverResponse.data.errors.saturation_mode" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.call_slip">
                            <li v-for="e in serverResponse.data.errors.call_slip" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.proposal_accepted">
                            <li v-for="e in serverResponse.data.errors.proposal_accepted" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.client_response1">
                            <li v-for="e in serverResponse.data.errors.client_response1" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.date_received">
                            <li v-for="e in serverResponse.data.errors.date_received" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.ff_calls_made">
                            <li v-for="e in serverResponse.data.errors.ff_calls_made" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.last_ffup_date">
                            <li v-for="e in serverResponse.data.errors.last_ffup_date" :key="e"> {{ e }}</li>
                        </template>
                        
                        <!-- CLIENT PRESENTATION -->
                        <template v-if="serverResponse.data.errors.date_presented">
                            <li v-for="e in serverResponse.data.errors.date_presented" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.presentor">
                            <li v-for="e in serverResponse.data.errors.presentor" :key="e"> {{ e }}</li>
                        </template>

                        <!-- Already declared in client calls  (same name so doesn't need to declare again)
                        <template v-if="serverResponse.data.errors.company">
                            <li v-for="e in serverResponse.data.errors.company" :key="e"> {{ e }}</li>
                        </template> -->
                        
                        <template v-if="serverResponse.data.errors.presentation_mode">
                            <li v-for="e in serverResponse.data.errors.presentation_mode" :key="e"> {{ e }}</li>
                        </template>
                        
                        <template v-if="serverResponse.data.errors.presentation_status">
                            <li v-for="e in serverResponse.data.errors.presentation_status" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.client_response2">
                            <li v-for="e in serverResponse.data.errors.client_response2" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.action_plan">
                            <li v-for="e in serverResponse.data.errors.action_plan" :key="e"> {{ e }}</li>
                        </template>

                        <!-- Client Acquisition -->

                        <template v-if="serverResponse.data.errors.status_as_of">
                            <li v-for="e in serverResponse.data.errors.status_as_of" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.acquired_by">
                            <li v-for="e in serverResponse.data.errors.acquired_by" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.date_acquired">
                            <li v-for="e in serverResponse.data.errors.date_acquired" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.signed_contract">
                            <li v-for="e in serverResponse.data.errors.signed_contract" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.manner_of_acquisition">
                            <li v-for="e in serverResponse.data.errors.manner_of_acquisition" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.initial_hc_acquired">
                            <li v-for="e in serverResponse.data.errors.initial_hc_acquired" :key="e"> {{ e }}</li>
                        </template>

                        <template v-if="serverResponse.data.errors.remarks">
                            <li v-for="e in serverResponse.data.errors.remarks" :key="e"> {{ e }}</li>
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