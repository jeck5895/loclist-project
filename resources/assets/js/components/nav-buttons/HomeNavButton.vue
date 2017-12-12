<template>
    <a @click.prevent="toHome" class="btn btn-sm btn-default" href="#">
        <span class="fa fa-home"></span> &nbsp;
            Home
    </a>
</template>

<script>
import router from '../../router/routes';

export default {
    methods: {
        toHome() {
            this.$store.dispatch('clearNationalities');
            this.$store.dispatch('clearIndustries');
            this.$store.dispatch('clearIsoCertificates');
            this.$store.dispatch('clearSourcingPractices');
            this.$store.dispatch('clearDepartments');
            this.$store.dispatch('clearPositions');
            this.$store.dispatch('clearManpowers');
            this.$store.dispatch('clearUserTypes');
            this.$store.dispatch('clearCompanies');
            router.push('/home');
        }
    }
}
</script>

<style>

</style>
