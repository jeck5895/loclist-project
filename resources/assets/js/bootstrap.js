
//window._ = require('lodash');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import moment from 'moment';
import toastr from 'toastr';
import VeeValidate from 'vee-validate';
import Auth from './package/Auth';
const VueInputMask = require('vue-inputmask').default;
// import VueToastr from '@deveodk/vue-toastr';
// import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css';

window.VeeValidate = VeeValidate;
window.moment = moment;
window.toastr = toastr;

Vue.use(VueInputMask);
Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.use(Auth);


Vue.filter('humanReadableFormat', function(date){
    return moment(date).format('MMMM Do, YYYY');
});

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default;//for bootstrap 4 dropdown
    //require('bootstrap-sass');
    require('bootstrap'); //for bootstrap 4 setup
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = 'http://localhost:8000';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
