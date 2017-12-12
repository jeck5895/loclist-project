<template>

    <ul class="nav py-2">
        <li class="nav-item" v-if="activePath != '/home'">
            <!-- <router-link class="btn btn-sm btn-default" to="/home">
                <span class="fa fa-home"></span> &nbsp;
                Home
            </router-link> -->
            <home-nav-button></home-nav-button>
        </li>
        <li class="nav-item pl-1" v-if="activePath != '/clients/create'">
            <!-- <router-link v-if="activePath != '/clients/create'" class="btn btn-sm btn-default" to="/clients/create">
                <span class="fa fa-user-plus"></span> &nbsp;
                Add New Client
            </router-link> -->
            <client-nav-button></client-nav-button>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> -->
    </ul>
</template>

<script>
    import ClientNavButton from '../nav-buttons/ClientsNavButton';
    import HomeNavButton from '../nav-buttons/HomeNavButton';
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
            HomeNavButton
        }
    }
</script>