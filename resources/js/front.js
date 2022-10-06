/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from './router.js'
import App from './components/App.vue'

const app = new Vue({
    router: router, // !!!! oppure semplicemente 'router' key=
    el: '#root',
    render: h => h(App),
});
