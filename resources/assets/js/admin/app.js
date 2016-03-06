var Loading = require('./components/Loading.vue');
var Auth = require('./components/Auth.vue');
var Login = require('./components/Login.vue');
var Content = require('./components/Content.vue');
var Dashboard = require('./components/Dashboard.vue');
var Category = require('./components/Category.vue');

var config = require('./config.js');
var auth = require('./helpers/auth.js');
var redirect = require('./helpers/redirect.js');

module.exports = {
    components: {
        'loading': Loading,
        'auth': Auth,
        'login': Login,
        'content': Content,
        'dashboard': Dashboard,
        'category': Category
    },
    
    methods: {
    	loading(type, timeout) {
            var type = type || 'show';

    		if (type == 'show') {
    			this.$broadcast('loading.show', {timeout: timeout});
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
    },

    events: {
        'auth.fail': function (message) {
            console.log(message);
        }
    }
}