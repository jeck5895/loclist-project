<template>
    <div class="sidebar">
        <div class="sidenav-links">
            <ul class="sidebar-nav">
                <li><h5 class="text-center">Form Keywords</h5></li>
                <li>
                    <a @click="addClass" :class="active" id="sidebar-toggle" data-toggle="collapse" href="#general-settings" aria-expanded="false">General Settings</a>
                    <div id="general-settings" class="collapse">
                        <div class="card border-0">
                            <div class="card-body">
                                <li>
                                    <router-link to="/maintainance/companies">Companies</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/departments">Departments</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/industries">Industries</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/iso-certificates">ISO Certificates</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/manpower-types">Manpower Types</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/nationalities">Nationalities</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/positions">Positions</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/sourcing-practices">Sourcing Practices</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/statuses">Statuses</router-link>
                                </li>
                                <li>
                                    <router-link to="/maintainance/user-types">User Types</router-link>
                                </li>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <router-link to="/maintainance/mode-of-saturations">Mode of Saturations</router-link>
                </li>
                <li>
                    <router-link to="/maintainance/manner-of-confirmations">Manner of Confirmations</router-link>
                </li>
                <li>
                    <router-link to="/maintainance/manner-of-acquisitions">Manner of Acquisitions</router-link>
                </li>
                <li>
                    <router-link to="/maintainance/mode-of-presentations">Mode of Presentations</router-link>
                </li>
                <li>
                    <router-link to="/maintainance/presentation-statuses">Presentation Statuses</router-link>
                </li>
                <li>
                    <router-link to="/maintainance/action-plans">Action Plans</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            // Vue.nextTick(() => {
            //   $('#general-settings a').each(function(){
            //         if($(this).hasClass('active')){
            //             $('#general-settings').collapse('show');
            //             $('#sidebar-toggle').addClass('active');
            //         }
            //     });
            // })
        },
        data() {
            return {
                active: ''
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
            }
        }
    }
</script>

<style>
    .sidebar {
        border-right: 1px solid #e2e2e2;
        position: fixed;
        width: 231px;
        top: 0;
        left: 0;
        padding-top: 65px;
        min-height: 100%;
        z-index: 1000;
        max-height: 100%;
        overflow-y: auto;
    }
    .card-body{
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
</style>