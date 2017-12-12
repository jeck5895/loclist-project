<template>
        <!-- <router-link to="/clients/create" class="btn btn-sm btn-default">
            <span class="fa fa-plus-circle"></span>
            Add Client
        </router-link> -->
        <a href="#" @click.prevent="createClient" class="btn btn-sm btn-default">
            <span class="fa fa-plus-circle"></span>
            Add Client
        </a>
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
                localStorage.setItem('f_type','CREATE_CLIENT');
                router.push('/clients/create');
            }
        }
    }
</script>