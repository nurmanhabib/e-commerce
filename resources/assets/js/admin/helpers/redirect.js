module.exports = {
	to(path) {
		var path = path || '';

		window.location.assign('/' + path);
	},

	toDashboard(path) {
		var path = path || '';

		this.to('admin/dashboard/' + path);
	},

	login() {
		this.to('admin');
	}
}