
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
//passport//
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
Vue.component('test', require('./components/test.vue'));

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('games', require('./components/games.vue'));
Vue.component('profilesidebar', require('./components/profilesidebar.vue'));
Vue.component('nowlivebar', require('./components/nowlivebar.vue'));
Vue.component('frontpagemain', require('./components/frontpagemain.vue'));
Vue.component('profilepagemain', require('./components/profilepagemain.vue'));
Vue.component('stream', require('./components/stream.vue'));

//dashboard//
Vue.component('dashboardstream', require('./components/dashboardstream.vue'));
Vue.component('dashboardprofile', require('./components/dashboardprofile.vue'));


Vue.component('chatroom', require('./components/Chatroom.vue'));

Vue.component('streams', require('./components/streamersByGame.vue'))


const app = new Vue({
    el: '#app',
    data: {
    	viewers: [],
        darkmode: false
    },
    methods: {
    	setUsers: function(users) {
    		this.viewers = users;
    	},
    	addUser: function(user) {
    		this.viewers.push(JSON.parse(JSON.stringify(user)));
    	},
    	removeUser: function(user) {
            for (var i = 0 ; i < this.viewers.length ; i++) {
                if(this.viewers[i].id == user.id) {
                    this.viewers.splice(i, 1);
                }
            }
    	},
        toggleDarkMode: function() {
            this.darkmode = !this.darkmode;
        }
    }
});
