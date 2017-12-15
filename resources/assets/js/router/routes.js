import VueRouter from 'vue-router';

let routes = [
    {
        path:'/home',
        component: require('../components/containers/Home.vue'),
        meta:{
            forAuthUsers:true
        }
    },
    {
        path:'/api-clients',
        component: require('../components/containers/OAuth.vue'),
        meta:{
            forAuthUsers:true
        }
    },
    {
        path:'/clients/create',
        component: require('../components/containers/AddClient.vue'),
        meta:{
            forAuthUsers:true
        }
    },
    {
        path:'/clients/details/:companyName/:clientId',
        name:'viewClient',
        component: require('../components/profiles/client/ClientProfile.vue'),
        meta:{
            forAuthUsers:true
        }
    },
    {
        path: '/maintainance',
        component: require('../components/containers/Maintainance.vue'),
        meta: {
            forAuthUsers: true
        }
    },
    {
        path: '/users',
        component: require('../components/containers/Users.vue'),
        meta: {
            forAuthUsers: true
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