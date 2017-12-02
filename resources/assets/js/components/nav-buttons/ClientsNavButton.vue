<template>

    <div class="mb-2 mt-2">
        
        <!-- <router-link to="/clients/create" class="btn btn-sm btn-default">
            <span class="fa fa-plus-circle"></span>
            Add Client
        </router-link> -->
        <a href="#" @click.prevent="createClient" class="btn btn-sm btn-default">
            <span class="fa fa-plus-circle"></span>
            Add Client
        </a>
    </div>
</template>

<script>
    import router from '../../router/routes';

    export default {
        
        methods: {
            createClient() {
                /**
                 * Clear arrays of state before setting it again
                 * because it will cause errors before rendering
                 * create client page
                 */
                this.$store.dispatch('clearNationalities');
                this.$store.dispatch('clearIndustries');
                this.$store.dispatch('clearIsoCertificates');
                this.$store.dispatch('clearSourcingPractices');
                this.$store.dispatch('clearDepartments');
                this.$store.dispatch('clearPositions');
                this.$store.dispatch('clearManpowers');
                this.$store.dispatch('clearUserTypes');
                router.push('/clients/create');
            }
        }
    }
</script>