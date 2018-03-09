<template>
    <div :class="!sideBarIsHidden ? 'sidebar animated slideInLeft' : 'sidebar animated slideOutLeft'">
        <div class="sidenav-links">
            <ul class="sidebar-nav">
                <li>
                    <h5>Form Keywords</h5> 
                    <span @click="toggleSidebar" style="cursor:pointer" class="sidebar-toggle"><i class="fa fa-chevron-left"></i></span>
                </li>
                <li>
                    <router-link to="/maintenance/reports">Report Settings</router-link>
                </li>
                <li>
                    <a @click="addClass" :class="active" id="sidebar-toggle" data-toggle="collapse" href="#general-settings" aria-expanded="false">General Settings</a>
                    <div id="general-settings" class="collapse">
                        <div class="card border-0">
                            <div class="card-body">
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
                        </div>
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

<style>
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
        padding-top: 85px;
        min-height: 100%;
        z-index: 1000;
        max-height: 100%;
        overflow-y: auto;
    }
    .sidebar-toggle{
        position: absolute;
        right: 1rem;
        top: 0rem;
    }
    .card-body{
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
</style>