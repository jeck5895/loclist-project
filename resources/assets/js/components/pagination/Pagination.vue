<template>
    <div class="row clearfix">
        <div class="col-md-4 float-left">
           Displaying from {{ object.from }} to {{ object.to }} total of {{ object.total }}
        </div>
        
        <div class="col-md-8 float-right">
            <nav aria-label="...">
                <ul :class="'pagination ' + classSize +' justify-content-end'">
                    <li :class="object.first_page_url == null ? 'page-item disabled' : '' ">
                        <a class="page-link" @click.prevent="firstPage(object.first_page_url)" href="#" tabindex="-1">
                            <span class="fa fa-long-arrow-left"></span>
                        </a>
                    </li>
                    <li :class="object.prev_page_url == null ? 'page-item disabled' : 'page-item'">
                        <a class="page-link" @click.prevent="prevPage(object.prev_page_url)" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li :class="object.current_page == i ? 'page-item active':'active'" v-for="i in object.last_page" :key="i">
                        <a class="page-link" @click.prevent="toPage(i)" href="#">{{ i }}</a>
                    </li>
                    <li :class="object.next_page_url == null ? 'page-item disabled' : 'page-item'">
                        <a class="page-link" @click.prevent="nextPage(object.next_page_url)" href="#">Next</a>
                    </li>
                    <li :class="object.last_page_url == null ? 'page-item disabled' : '' ">
                        <a class="page-link" @click.prevent="lastPage(object.last_page_url)" href="#">
                            <span class="fa fa-long-arrow-right"></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        props:['scope','object', 'url', 'classSize', 'query'],
        created(){
            // console.log(this.$route)
        },
        computed:{

        },
        methods:{
            toPage(page){
                var bool = this.url.includes('?');
                var url = bool ? this.url + "&page=" + page : this.url + "?page=" + page;
                switch (this.scope) {
                    case "users":
                        this.$store.dispatch('loadUsers', url);
                        break;
                    case "industries":
                        this.$store.dispatch('loadIndustries', url)
                        break;
                    case "nationalities":
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "certificates":
                        this.$store.dispatch('loadCertificates', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    case "departments":
                        this.$store.dispatch('loadDepartments', url);
                        break;
                    case "positions":
                        this.$store.dispatch('loadPositions', url);
                        break;
                    case "manpowers":
                        this.$store.dispatch('loadManpowers', url);
                        break;
                    case "user_types":
                        this.$store.dispatch('loadUserTypes', url);
                        break;
                    case "companies":
                        this.$store.dispatch('loadCompanies', url);
                        break;
                    case "clients":
                        this.$store.dispatch('loadClients', url);
                        break;
                    case "calls": 
                        this.$store.dispatch('loadClientCalls', url);
                        break;
                    case "client_saturations":
                        this.$store.dispatch('loadClientSaturations', url);
                        break;
                    default:
                        break;
                }
            },
            nextPage (url) {
                var url = url + '&' + this.query;
                switch (this.scope) {
                    case "users":
                        this.$store.dispatch('loadUsers', url);
                        break;
                    case "industries":
                        this.$store.dispatch('loadIndustries', url)
                        break;
                    case "nationalities":
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "certificates":
                        this.$store.dispatch('loadCertificates', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    case "departments":
                        this.$store.dispatch('loadDepartments', url);
                        break;
                    case "positions":
                        this.$store.dispatch('loadPositions', url);
                        break;
                    case "manpowers":
                        this.$store.dispatch('loadManpowers', url);
                        break;
                    case "user_types":
                        this.$store.dispatch('loadUserTypes', url);
                        break;
                    case "companies":
                        this.$store.dispatch('loadCompanies', url);
                        break;
                    case "clients":
                        this.$store.dispatch('loadClients', url);
                        break;
                    case "calls": 
                        this.$store.dispatch('loadClientCalls', url);
                        break;
                    case "client_saturations":
                        this.$store.dispatch('loadClientSaturations', url);
                        break;
                    default:
                        break;
                }
            },
            prevPage (url) {
                var url = url + '&' + this.query;
                switch (this.scope) {
                    case "users":
                        this.$store.dispatch('loadUsers', url);
                        break;
                    case "industries":
                        this.$store.dispatch('loadIndustries', url)
                        break;
                    case "nationalities":
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "certificates":
                        this.$store.dispatch('loadCertificates', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    case "departments":
                        this.$store.dispatch('loadDepartments', url);
                        break;
                    case "positions":
                        this.$store.dispatch('loadPositions', url);
                        break;
                    case "manpowers":
                        this.$store.dispatch('loadManpowers', url);
                        break;
                    case "user_types":
                        this.$store.dispatch('loadUserTypes', url);
                        break;
                    case "companies":
                        this.$store.dispatch('loadCompanies', url);
                        break;
                    case "clients":
                        this.$store.dispatch('loadClients', url);
                        break;
                    case "calls": 
                        this.$store.dispatch('loadClientCalls', url);
                        break;
                    case "client_saturations":
                        this.$store.dispatch('loadClientSaturations', url);
                        break;
                    default:
                        break;
                }
            },
            firstPage(url){
                var url = url + '&' + this.query;
                switch (this.scope) {
                    case "users":
                        this.$store.dispatch('loadUsers', url);
                        break;
                    case "industries":
                        this.$store.dispatch('loadIndustries', url);
                        break;
                    case "nationalities":
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "certificates":
                        this.$store.dispatch('loadCertificates', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    case "departments":
                        this.$store.dispatch('loadDepartments', url);
                        break;
                    case "positions":
                        this.$store.dispatch('loadPositions', url);
                        break;
                    case "manpowers":
                        this.$store.dispatch('loadManpowers', url);
                        break;
                    case "user_types":
                        this.$store.dispatch('loadUserTypes', url);
                        break;
                    case "companies":
                        this.$store.dispatch('loadCompanies', url);
                        break;
                    case "clients":
                        this.$store.dispatch('loadClients', url);
                        break;
                    case "calls": 
                        this.$store.dispatch('loadClientCalls', url);
                        break;
                    case "client_saturations":
                        this.$store.dispatch('loadClientSaturations', url);
                        break;
                    default:
                        break;
                }
            },
            lastPage(url){
                var url = url + '&' + this.query;
                switch (this.scope) {
                    case "users":
                        this.$store.dispatch('loadUsers', url);
                        break;
                    case "industries":
                        this.$store.dispatch('loadIndustries', url)
                        break;
                    case "nationalities":
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "certificates":
                        this.$store.dispatch('loadCertificates', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    case "departments":
                        this.$store.dispatch('loadDepartments', url);
                        break;
                    case "positions":
                        this.$store.dispatch('loadPositions', url);
                        break;
                    case "manpowers":
                        this.$store.dispatch('loadManpowers', url);
                        break;
                    case "user_types":
                        this.$store.dispatch('loadUserTypes', url);
                        break;
                    case "companies":
                        this.$store.dispatch('loadCompanies', url);
                        break;
                    case "clients":
                        this.$store.dispatch('loadClients', url);
                        break;
                    case "calls": 
                        this.$store.dispatch('loadClientCalls', url);
                        break;
                    case "client_saturations":
                        this.$store.dispatch('loadClientSaturations', url);
                        break;
                    case "saturations":
                        this.$store.dispatch('loadSaturations', url);
                        break;
                    case "confirmations":
                        this.$store.dispatch('loadConfirmations', url);
                        break;
                    default:
                        break;
                }
            },
        }
    }
</script>

<style>

</style>