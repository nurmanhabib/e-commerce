var _ = require('underscore');
var Vue = require('vue');
var app = require('./app.js');
var event = require('./event.js');
var cookie = require('./cookie.js');
var redirect = require('./redirect.js');
var config = require('./../config.js');

module.exports = {
    setApp(_app) {
        app.setApp(_app);
    },

    getApp() {
        return app.getApp();
    },

    hasApp() {
        return app.hasApp();
    },

    attempt(credentials, expected_roles, remember) {
        var credentials = credentials || {};
        var expected_roles = expected_roles || [];
        var remember = remember || false;

        return new Promise(function (resolve, reject) {
            _.extend(credentials, {expected_roles: expected_roles});

            app.http().post('auth/credentials', credentials).then(function (response) {
                var data = response.data;

                if (data.status == 'success') {
                    var token = data.token;
                    var user = data.user;
                    var roles = user.roles;

                    resolve(token, user, roles);
                } else {
                    reject(data.message);
                }
            }, function (response) {
                reject(response.data.message);
            });
        });
    },

    attemptById(id, expected_roles) {
        var expected_roles = expected_roles || [];

        return new Promise(function (resolve, reject) {
            var data = {id: id, expected_roles: expected_roles};

            app.http().post('auth/id', data).then(function (response) {
                var data = response.data;

                if (data.status == 'success') {
                    var token = data.token;
                    var user = data.user;
                    var roles = user.roles;

                    resolve(token, user, roles);
                } else {
                    reject(data.message);
                }
            }, function (response) {
                reject(response.data.message);
            });
        });
    },

    attemptByRemember(expected_roles) {
        if (this.hasRememberToken()) {
            var remember_token = this.getRememberToken();
            var expected_roles = expected_roles || [];

            return new Promise(function (resolve, reject) {
                var data = {
                    remember_token: remember_token,
                    expected_roles: expected_roles
                };
                
                app.http().post('auth/remember', data).then(function (response) {
                    var data = response.data;

                    if (data.status == 'success') {
                        var token = data.token;
                        var user = data.user;
                        var roles = user.roles;

                        resolve(token, user, roles);
                    } else {
                        reject(data.message);
                    }
                }, function (response) {
                    reject(response.data.message);
                });                
            });
        } else {
            return false;
        }
    },

    refreshToken() {
        var that = this;

        return new Promise(function (resolve, reject) {
            app.http().post('auth/refresh-token').then(function (response) {
                var data = response.data;
                var user = data.user;
                var token = data.token;

                that.saveToken(token);

                resolve(user, token);
            }, function (response) {
                reject(response.data.message);
            });
        });
    },

    check(expected_roles) {
        var that = this;
        var user = this.user();

        return new Promise(function (resolve, reject) {
            if (user === false) {
                reject('You have not logged.');
            }

            user.then(function (user) {
                var roles = user.roles;
                var check = that.checkRoles(roles, expected_roles);

                if (check) {
                    resolve(user, roles);
                } else {
                    reject('You do not have access rights.');
                }
            }, function (message) {
                reject(message);
            });
        });
    },

    user() {
        if (this.hasToken()) {
            var that = this;
            var token = this.getToken();

            return new Promise(function (resolve, reject) {
                app.http().get('user').then(function (response) {
                    var data = response.data;

                    if (data.status == 'success') {
                        var user = data.user;
                        var roles = user.roles;

                        resolve(user, roles);
                    } else {
                        reject(data.message);
                    }
                }, function (response) {
                    reject(response.data.message);
                })
            });
        } else {
            return false;
        }
    },

    saveToken(token, remember_token) {
        // Token disimpan di cookie
        cookie.set('token', token);

        // Set remember jika user memilih opsi 'remember me'
        if (remember_token) {
            this.saveRememberToken(remember_token);
        }
    },

    hasToken() {
        return cookie.has('token');
    },

    getToken() {
        return cookie.get('token');
    },

    saveRememberToken(remember_token) {
        cookie.set('remember_token', remember);
    },

    hasRememberToken() {
        return cookie.has('remember_token');
    },

    getRememberToken() {
        return cookie.get('remember_token');
    },

    checkRoles(roles, expected_roles) {
        var expected_roles = expected_roles || [];

        if (_.isEmpty(expected_roles)) {
            return true;
        }

        var roles = _.pluck(roles, 'slug');
        var roled = _.intersection(roles, expected_roles);

        return _.size(roled) > 0;
    },

    getAuthHeaders() {
        return 'Bearer ' + this.getToken();
    },

    setGlobalAuthHeaders() {
        if (this.hasToken()) {
            Vue.http.headers.common['Authorization'] = this.getAuthHeaders();
        }
    },

    logout() {
        cookie.forget('token');
    },

    getToken() {
        return cookie.get('token');
    },
}