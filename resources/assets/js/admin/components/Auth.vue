<script lang="es6">
	var _ = require('underscore');
	var Vue = require('vue');
	// var Promise = require('promise-polyfill');
	// var setAsap = require('setasap');

	var redirect = require('./../helpers/redirect.js');
	var auth = require('./../helpers/auth.js');
	var cookie = require('./../helpers/cookie.js');

	module.exports = {
		props: {
			role: 'String'
		},

		methods: {
			hasToken() {
				return cookie.has('token');
			},

			getToken() {
				return cookie.get('token');
			},

			getAuthHeaders() {
				return 'Bearer ' + this.getToken();
			},

			/**
			 * Check apakah token valid, jika tidak maka di redirect ke login
			 * @return {void}
			 */
			check() {
				if (this.hasToken() === false) {
					return false;
				}

				return true;
			},

			getRoles() {
				var that = this;

				return new Promise(function (resolve, reject) {
					that.$http.get('user/roles').then(function (response) {
						var roles = response.data.roles;
						var slugRoles = _.pluck(roles, 'slug');

						resolve(slugRoles);
					});
				});
			},

			hasRole(checkRoles) {
				var that = this;

				return new Promise(function (resolve, reject) {
					that.getRoles().then(function (userRoles) {
						var intersection = _.intersection(userRoles, checkRoles);

						if (_.size(intersection) === 0) {
							return reject(null);
						} else {
							return resolve(intersection);
						}
					});
				});
			}
		},

		ready() {
			// Jika belum ada token, maka dianggap belum login dan redirect login
			if (this.check() === false) {
				redirect.login();
			}

			Vue.http.headers.common['Authorization'] = 'Bearer ' + this.getToken();

			var userRoles = this.role.split(',');

			this.hasRole(userRoles).then(function (roled) {
				// User has role
				// Allow access page
			}, function (err) {
				// User has not roled, redirect login
				redirect.login();
			});
		}
	}
</script>