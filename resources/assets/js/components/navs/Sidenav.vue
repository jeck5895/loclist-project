<template>
    <div :class="!sideBarIsHidden ? 'sidebar animated slideInLeft' : 'sidebar animated slideOutLeft'">
        <div class="sidenav-links">
            <ul class="sidebar-nav">
                <li>
                    <h5 class="ml-5">Configurations</h5> 
                </li>
                <li>
                    <router-link to="/maintenance/reports">Report Settings</router-link>
                </li>
                <li>
                    <a @click="addClass" :class="active + ' with-submenu'" id="sidebar-toggle" data-toggle="collapse" href="#general-settings" aria-expanded="false">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="menu-collapsed">General Settings</span>
                        <span class="submenu-icon ml-auto"></span>
                </div>
                    </a>
                    <div id="general-settings" class="collapse">
                        
                                <li>
                                    <router-link to="/maintenance/companies">Companies</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/departments">Departments</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/industries">Industries</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/iso-certificates">ISO Certificates</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/manpower-types">Manpower Types</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/nationalities">Nationalities</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/positions">Positions</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/sourcing-practices">Sourcing Practices</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/statuses">Statuses</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintenance/user-types">User Types</router-link>
                                </li>
                           
                    </div>
                </li>
                <li>
                    <router-link to="/maintenance/mode-of-saturations">Mode of Saturations</router-link>
                </li>
                <li>
                    <router-link to="/maintenance/manner-of-confirmations">Manner of Confirmations</router-link>
                </li>
                <li>
                    <router-link to="/maintenance/manner-of-acquisitions">Manner of Acquisitions</router-link>
                </li>
                <li>
                    <router-link to="/maintenance/mode-of-presentations">Mode of Presentations</router-link>
                </li>
                <li>
                    <router-link to="/maintenance/presentation-statuses">Presentation Statuses</router-link>
                </li>
                <li>
                    <router-link to="/maintenance/action-plans">Action Plans</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        created() {

        },
        data() {
            return {
                active: '',
            }
        },
        computed: {
            sideBarIsHidden() {
                return this.$store.getters.getSideBarState;
            }
        },
        methods:{
            addClass(e) {
                if($('#general-settings').hasClass('show')) {
                    this.active = '';
                }
                else {
                    this.active = 'active'
                }
            },
            toggleSidebar(){
                if(this.sideBarIsHidden){
                    this.$store.dispatch('setSideBarState', false);
                }
                else{
                    this.$store.dispatch('setSideBarState', true);
                }
            }
        }
    }
</script>

<style lang="scss">
    @import '~styles/variables';
    .sidebar.show{
        display: block;
    }
    .sidebar.hide{
        display: none;
    }
    .sidebar {
        border-right: 1px solid #e2e2e2;
        position: fixed;
        width: 214px;
        top: 0;
        left: 0;
        padding-top: 75px;
        min-height: 100%;
        z-index: 1000;
        max-height: 100%;
        overflow-y: auto;
    }
    
    .sidebar a{
        color: $bg-teal;//#343a40;
    }

    .card-body{
        padding-top: 1rem;
        padding-bottom: 1rem;
    }


#general-settings >li>a {
    display: block;
    width: 100%;
    padding: 0.25rem 1rem;
    font-size: 12px;
    border-top: 1px solid #efefef;
    background: #fff;
}

#general-settings >li>a:hover {
    text-decoration: none;
    background-color: $bg-teal;
    color:#ffff!important;
}
    /* Closed submenu icon */

 .with-submenu[aria-expanded="false"] .submenu-icon::after {
    content: "\f107";
    font-family: FontAwesome;
    position: relative;
    float: right;
    padding-left: 10px;
}

/* Opened submenu icon */

.with-submenu[aria-expanded="true"] .submenu-icon::after {
    content: "\f106";
    font-family: FontAwesome;
    position: relative;
    float: right;
    padding-left: 10px;
}

</style>