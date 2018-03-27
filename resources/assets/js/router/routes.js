import VueRouter from 'vue-router';
import maintenanceChildrenRoutes from './children/maintenance/maintenanceChildrenRoutes';

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
        path: '/clients/edit/:companyName/:clientId',
        name: 'editClient',
        component: require('../components/containers/AddClient.vue'),
        meta: {
            forAuthUsers: true
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
        path: '/maintenance',
        component: require('../components/containers/Maintenance.vue'),
        meta: {
            forAuthUsers: true
        },
        children: maintenanceChildrenRoutes
    },
    {
        path: '/users',
        component: require('../components/containers/Users.vue'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
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
    linkExactActiveClass: 'active',
    linkActiveClass: 'active',
});