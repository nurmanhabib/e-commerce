var Loading = require('./components/Loading.vue');
var Auth = require('./components/Auth.vue');
var Login = require('./components/Login.vue');
var Content = require('./components/Content.vue');
var Dashboard = require('./components/Dashboard.vue');
var Sidebar = require('./components/Sidebar.vue');
var Products = require('./components/Product.vue');

var config = require('./config.js');
var auth = require('./helpers/auth.js');
var app = require('./helpers/app.js');
var event = require('./helpers/event.js');
var redirect = require('./helpers/redirect.js');

module.exports = {
    components: {
        'loading': Loading,
        'auth': Auth,
        'login': Login,
        'sidebar': Sidebar,
        'content': Content,
        'products': Products,
        'dashboard': Dashboard,
    },
    
    methods: {
    	loading(type, timeout) {
            var type = type || 'show';

    		if (type == 'show') {
    			this.$broadcast('loading.show', timeout);
    		} else if (type == 'hide') {
    			this.$broadcast('loading.hide');
    		}
    	},

    	loaded() {
    		this.$broadcast('loading.hide');
    	},

        logout() {
            auth.logout();

            redirect.login();
        }
    },

    ready() {
        this.loaded();

        app.setApp(this);
        event.setApp(this);
    },

    events: {
        'auth.authenticating': function (credentials) {
            // 
        },

        'auth.authenticated': function (token, user, roles) {
            // 
        },

        'auth.failed': function (message) {
            //
        }
    }
}