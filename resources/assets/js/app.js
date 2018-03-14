
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('games', require('./components/games.vue'));
Vue.component('profilesidebar', require('./components/profilesidebar.vue'));
Vue.component('nowlivebar', require('./components/nowlivebar.vue'));
Vue.component('frontpagemain', require('./components/frontpagemain.vue'));
Vue.component('profilepagemain', require('./components/profilepagemain.vue')); 

Vue.component('chatroom', require('./components/Chatroom.vue'));


const app = new Vue({
    el: '#app'
});
