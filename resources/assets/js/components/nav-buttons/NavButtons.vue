<template>

    <ul class="nav py-2">
        <li class="nav-item" v-if="activePath != '/home'">
            <home-nav-button></home-nav-button>
        </li>
        <li class="nav-item pl-1" v-if="activePath != '/clients/create'">
            <client-nav-button></client-nav-button>
        </li>
        <li class="nav-item pl-1" v-if="activePath == '/users'">
            <user-nav-button></user-nav-button>
        </li>
    </ul>
</template>

<script>
    import ClientNavButton from '../nav-buttons/ClientsNavButton';
    import HomeNavButton from '../nav-buttons/HomeNavButton';
    import UserNavButton from '../nav-buttons/UserNavButton';
    export default {
        mounted() {
            //console.log(this.$route)
        },
        data() {
            return {
                activePath: this.$route.path
            }
        },
        components:{
            ClientNavButton,
            HomeNavButton,
            UserNavButton
        }
    }
</script>