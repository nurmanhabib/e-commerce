var app = require('./app.js');

module.exports = {
	_app: null,

	setApp(app) {
		this._app = app;
	},

	getApp() {
		return this._app;
	},

	fire(name, data) {
		this.getApp().$emit(name, data);
		this.getApp().$broadcast(name, data);
	},

	listen(name, callback) {
		this.getApp().$on(name, callback);
	}
}