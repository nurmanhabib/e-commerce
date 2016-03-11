var config = require('./../config.js');

module.exports = {
	to(path) {
		var path = path || '';

		path = path.replace(/^\/|\/$/g, '');

		if (/:\/\//.test(path)) {
			return path;
		} else {
			return config.SITE_URL + '/' + path;
		}
	},

	asset(path) {
		var path = path || '';

		path = path.replace(/^\/|\/$/g, '');

		if (/:\/\//.test(path)) {
			return path;
		} else {
			return config.BASE_URL + '/' + path;
		}
	},

	node_modules(path) {
		return this.asset('node_modules/' + path);
	},

	login() {
		return this.to('login');
	},

	logout() {
		return this.to('logout');
	}
}