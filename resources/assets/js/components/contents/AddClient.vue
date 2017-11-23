<template>
    <div class="row  justify-content-center">
        <div class="col-md-8" data-spy="scroll" data-target="#spy-form" data-offset="0">
            
            <div class="alert alert-info mb-1" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading mb-0">Reminders
                    <span class="fa fa-exclamation-circle"></span>
                </h4>
                <hr class="mt-1 mb-2">
                <p class="mb-0">All fields are required. Please put N/A for fields that you think unnecessary for the mean time.</p>
            </div>
            <nav-buttons></nav-buttons>
            <!-- Client Details -->
            <client-details-form></client-details-form>

            <!-- CALLS SECTION -->
            <client-calls-form></client-calls-form>

            <!-- Client Saturation -->
            <client-saturation-form></client-saturation-form>

            <!-- Client Presentation -->
            <client-presentation-form></client-presentation-form>

            <!-- Acquisition Section -->
            <client-acquisition-form></client-acquisition-form>
        </div>

        <div class="col-md-2">
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
        </div>
    </div>
</template>

<script>
    import ClientDetailsForm from "../forms/ClientDetailsForm";
    import ClientPresentationForm from "../forms/ClientPresentationForm";
    import ClientCallsForm from "../forms/ClientCallsForm";
    import ClientSaturationForm from "../forms/ClientSaturationForm";
    import ClientAcquisitionForm from "../forms/ClientAcquisitionForm";
    import NavButtons from '../nav-buttons/NavButtons';

    export default {
        created() {},
        computed: {},
        components: {
            ClientDetailsForm,
            ClientCallsForm,
            ClientSaturationForm,
            ClientPresentationForm,
            ClientAcquisitionForm,
            NavButtons,
        }
    };
</script>

<style scoped>
    a:hover {
        text-decoration: none;
    }
</style>