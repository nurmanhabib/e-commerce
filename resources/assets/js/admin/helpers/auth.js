var cookie = require('./cookie.js');
var redirect = require('./redirect.js');
var config = require('./../config.js');

module.exports = {
	logout() {
		cookie.forget('token');
	},

	getToken() {
		return cookie.get('token');
	},

	/**
	 * Check apakah token valid, jika tidak maka di redirect ke login
	 * @return {void}
	 */
	check() {
		if (cookie.has('token') === false) {
			return false;
		}

		return true;
	},

	/**
	 * Check apakah user mempunyai hak akses
	 * @param  {string}  name Nama role
	 * @return {void}
	 */
	hasRole(name) {
		
	}
}