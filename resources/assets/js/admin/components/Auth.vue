<template>
    <slot></slot>
</template>

<script lang="es6">
    var _ = require('underscore');
    var Vue = require('vue');

    var redirect = require('./../helpers/redirect.js');
    var event = require('./../helpers/event.js');
    var loading = require('./../helpers/loading.js');
    var url = require('./../helpers/url.js');
    var auth = require('./../helpers/auth.js');

    module.exports = {
        props: {
            role: String,
            redirect: {
                type: String,
                default: url.login()
            },
            error: ''
        },

        methods: {
            hasToken() {
                return auth.hasToken();
            },

            getToken() {
                return auth.getToken();
            },

            getUser() {
                return auth.user();
            },

            getAuthHeaders() {
                return auth.getAuthHeaders();
            },

            getRoles() {
                return auth.getRoles();
            }
        },

        ready() {
            var that = this;

            auth.setApp(this.$root);
            event.setApp(this.$root);

            // Fire event auth.checking
            event.fire('loading.show');
            event.fire('auth.checking');

            auth.setGlobalAuthHeaders();

            // Proses pengecekan user apakah admin bukan
            auth.check(['admin']).then(function (user, roles) {
                event.fire('auth.checked', {user: user, roles: roles});
                event.fire('loading.hide');
            }, function (message) {
                that.error = message;
                event.fire('auth.failed', message);

                redirect.to(that.redirect);
            });
        }
    }
</script>