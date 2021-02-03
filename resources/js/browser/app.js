require('../bootstrap');
import VueRouter from 'vue-router';

window.Vue = require('vue');
Vue.use(VueRouter);

import router from './routes/vue-router';

import App from './components/App';

/**
 * Define All your Components Here.
 */
Vue.component('profile-component', require('../browser/components/dashboard/ProfileComponent').default);
Vue.component('login-component', require('../browser/components/auth/LoginComponent').default);


const app = new Vue({
  el: '#vue_browser',
  components: { App },
  router: router
});