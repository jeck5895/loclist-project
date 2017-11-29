<template>
    <nav aria-label="...">
        <ul :class="'pagination ' + classSize +' justify-content-center'">
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
</template>

<script>
    export default {
        props:['scope','object', 'url', 'classSize'],
        created(){
            console.log(this.$route)
        },
        computed:{

        },
        methods:{
            toPage(page){
                var url = this.url + "?page=" + page;
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
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    default:
                        break;
                }
            },
            nextPage (url) {
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
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    default:
                        break;
                }
            },
            prevPage (url) {
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
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    default:
                        break;
                }
            },
            firstPage(url){
                //console.log(url)
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
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
                        break;
                    default:
                        break;
                }
            },
            lastPage(url){
                //console.log(url)
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
                        this.$store.dispatch('loadNationalities', url);
                        break;
                    case "sourcing_practices":
                        this.$store.dispatch('loadSourcingPractices', url);
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