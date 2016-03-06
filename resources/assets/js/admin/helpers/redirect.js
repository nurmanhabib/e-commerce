var url = require('./url.js');

module.exports = {
	to(path) {
		var path = path || '';
		var redirect = url.to(path);

		window.location.assign(redirect);
	},

	toDashboard(path) {
		var path = path || '';

		this.to('dashboard/' + path);
	},

	login() {
		this.to('/');
	}
}