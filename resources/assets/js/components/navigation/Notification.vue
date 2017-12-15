<template>
    <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fa fa-flag"></span>
        </a>
        <div class="dropdown-menu dropdown-notification dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <h4 class="dropdown-header">Notifications</h4>
            <div class="dropdown-divider"></div>
            <router-link class="dropdown-item" to="/home">
                Some Notifications here...
            </router-link>
        </div>
    </li>
</template>

<script>
    export default {

    };
</script>

<style>
    .dropdown-notification {
        width: 400px!important;
    }
    .dropdown-header{
        font-size: 0.875rem;
        padding: 0.25rem 1.50rem;
    }
    .dropdown-divider{
        margin: 0.25rem 0;
    }
</style>