var config = require('./../config.js');

module.exports = {
	to(path) {
		var path = path || '';

		path = this.removeTrailingSlash(path);

		if (/:\/\//.test(path)) {
			return path;
		} else {
			return this.removeTrailingSlash(config.SITE_URL + '/' + path);
		}
	},

	asset(path) {
		var path = path || '';

		path = this.removeTrailingSlash(path);

		if (/:\/\//.test(path)) {
			return path;
		} else {
			return this.removeTrailingSlash(config.BASE_URL + '/' + path);
		}
	},

	removeTrailingSlash(path) {
		return path.replace(/^\/|\/$/g, '');
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