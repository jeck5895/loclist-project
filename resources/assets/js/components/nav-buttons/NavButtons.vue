<template>

    <ul class="nav justify-content-end py-2">
        <li class="nav-item">
            <router-link class="btn btn-sm btn-default" to="/home">
                <span class="fa fa-home"></span> &nbsp;
                Home
            </router-link>
        </li>
        <li class="nav-item pl-1">
            <router-link v-if="activePath != '/clients/create'" class="btn btn-sm btn-default" to="/clients/create">
                <span class="fa fa-user-plus"></span> &nbsp;
                Add New Client
            </router-link>
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
    export default {
        mounted() {
            //console.log(this.$route)
        },
        data() {
            return {
                activePath: this.$route.path
            }
        }
    }
</script>