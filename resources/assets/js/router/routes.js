import VueRouter from 'vue-router';

let routes = [
    {
        path:'/home',
        component: require('../components/contents/Home.vue'),
        meta:{
            forAuthUsers:true
        }
    },
    {
        path:'/api-clients',
        component: require('../components/contents/OAuth.vue'),
        meta:{
            forAuthUsers:true
        }
    },
    {
        path:'/clients/create',
        component: require('../components/contents/AddClient.vue'),
        meta:{
            forAuthUsers:true
        }
    },
    {
        path: "*",
         component: require('../components/errors/404.vue') 
    }
];

export default new VueRouter({
    routes,
    mode:'history',
    linkExactActiveClass: 'is-active',
    linkActiveClass: 'is-active'
});