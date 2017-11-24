<template>
    <div class="row  justify-content-center">
        <div class="col-md-8" data-spy="scroll" data-target="#spy-form" data-offset="0">
            <alert-reminder></alert-reminder>
            <nav-buttons></nav-buttons>
            <!-- Client Details -->
            <client-details-form></client-details-form>

            <!-- CALLS SECTION -->
            <!-- <client-calls-form></client-calls-form> -->

            <!-- Client Saturation -->
            <!-- <client-saturation-form></client-saturation-form> -->

            <!-- Client Presentation -->
            <!-- <client-presentation-form></client-presentation-form> -->

            <!-- Acquisition Section -->
            <!-- <client-acquisition-form></client-acquisition-form> -->
        </div>

        <!-- <div class="col-md-2">
            <ul class="list-unstyled fixed-right" id="spy-form">
                <li>
                    <h4 class="mb-0">Side Navigation</h4>
                </li>
                <li>
                    <hr class="mt-1 mb-2">
                </li>
                <li>
                    <h6>
                        <a href="#client-details" class="text-muted">Details</a>
                    </h6>
                </li>
                <li>
                    <h6>
                        <a href="#calls" class="text-muted">Calls</a>
                    </h6>
                </li>
                <li>
                    <h6>
                        <a href="#client-saturation" class="text-muted">Saturation</a>
                    </h6>
                </li>
                <li>
                    <h6>
                        <a href="#client-presentation" class="text-muted">Presentation</a>
                    </h6>
                </li>
                <li>
                    <h6>
                        <a href="#client-status" class="text-muted">Acquisition</a>
                    </h6>
                </li>
            </ul>
        </div> -->
    </div>
</template>

<script>
    import ClientDetailsForm from "../forms/ClientDetailsForm";
    import ClientPresentationForm from "../forms/ClientPresentationForm";
    import ClientCallsForm from "../forms/ClientCallsForm";
    import ClientSaturationForm from "../forms/ClientSaturationForm";
    import ClientAcquisitionForm from "../forms/ClientAcquisitionForm";
    import NavButtons from '../nav-buttons/NavButtons';
    import AlertReminder from '../alerts/AlertReminder';

    export default {
        created() {},
        computed: {},
        components: {
            ClientDetailsForm,
            // ClientCallsForm,
            // ClientSaturationForm,
            // ClientPresentationForm,
            // ClientAcquisitionForm,
            NavButtons,
            AlertReminder
        }
    };
</script>

<style scoped>
    a:hover {
        text-decoration: none;
    }
</style>