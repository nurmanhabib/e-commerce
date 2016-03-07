var Vue = require('vue');
var _ = require('underscore');
var cookie = require('./cookie.js');
var redirect = require('./redirect.js');
var config = require('./../config.js');

module.exports = {
    attempt(credentials, expectedRoles, remember) {
        var credentials = credentials || {};
        var expectedRoles = expectedRoles || '';
        var remember = remember || false;

        return new Promise(function (resolve, reject) {
            expectedRoles = expectedRoles.split(',');
            _.extend(credentials, {expected_roles: expectedRoles});

            Vue.http.post('auth/credentials', credentials).then(function (response) {
                var data = response.data;

                if (data.status == 'success') {
                    resolve(response);
                } else {
                    reject({
                        status: 'failed',
                        message: data.message,
                        data: data
                    });
                }
            }, function (response) {
                // Error with API
                reject({
                    status: 'error',
                    message: response.data.message,
                    data: response.data
                });
            });
        });
    },

    saveToken(token, remember) {
        // Token disimpan di cookie
        cookie.set('token', token);

        // Set remember jika user memilih opsi 'remember me'
        if (remember)
            cokie.set('remember', 'true');
    },

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