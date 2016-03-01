var Loading = require('./components/Loading.vue');
var Content = require('./components/Content.vue');
var config = require('./components/Config.vue');

module.exports = {
	http: {
		root: config['api_root'],
		headers: config['headers']
	},
    components: {
        'loading': Loading,
        'content': Content
    },
    methods: {
    	loading(type, timeout) {
    		if (typeof type == 'undefined') {
    			type = 'show';
    		}

    		if (type == 'show') {
    			this.$broadcast('loading.show', {timeout: timeout});
    		} else if (type == 'hide') {
    			this.$broadcast('loading.hide');
    		}
    	},
    	loaded() {
    		this.$broadcast('loading.hide');
    	}
    }
}