
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import router from './router/routes';
import {store} from './store/store';
import Notification from './components/navigation/Notification';

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.forAuthUsers)){
        if(!Vue.auth.isAuthenticated()){
            // next({
            //     path:'/home'
            // });
            window.location = window.location.origin;
        }
        else{
            next();
        }
    }
    else{
        next();
    }
});

const app = new Vue({
    el: '#app',
    data:{
        onlineStatus: navigator.onLine,
    },
    store,
    router:router,
    components:{
        Notification
    },
    methods:{
        signOut(){
            localStorage.removeItem('_u');
            window.location = `https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=${window.location.protocol}//${window.location.host}/auth/logout`;
        },
        toUrlFormat(param) {
            let temp = param.replace(/[^a-zA-Z0-9\s\-]/g, "");
            return temp.replace(/\s+/g, "-").toLowerCase();
        },
    },
    created(){
        Vue.auth.setter();
    },
});

