
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
            //     path:'/'
            // })
            
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
    created(){
        
    },
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
            window.location = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost:8000/auth/logout";
        }
    },
    created(){
        Vue.auth.setter();
    },
});

