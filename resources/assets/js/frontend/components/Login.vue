<template>
    <div v-if="error" class="alert alert-danger alert-styled-left alert-bordered">
        <button v-on:click="clearError()" type="button" class="close"><span>&times;</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">{{ error }}</span>
    </div>
    
    <form v-on:submit.prevent="login()">
        <div class="form-group">
            <label for="Account">Account :</label>
            <input type="email" class="form-control" v-model="credentials.email" placeholder="Email addres or member ID">
        </div>
        <div class="form-group">
            <label for="Password">Password :</label>
            <label for="forgot" class="pull-right"><a href="#">Forgot Password?</a></label>
            <input type="password" class="form-control" v-model="credentials.password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-block btn-login">LOGIN</button>
        <p>Don't have Account - <a href="#">Join Free</a></p>
    </form>
</template>

<script lang="es6">
    var cookie = require('./../helpers/cookie.js');
    var auth = require('./../helpers/auth.js');
    var loading = require('./../helpers/loading.js');
    var event = require('./../helpers/event.js');
    var redirect = require('./../helpers/redirect.js');

    module.exports = {
        data() {
            return {
                credentials: {
                    email: '',
                    password: ''
                },
                remember: false,
                error: ''
            }
        },

        methods: {
            login() {
                var that = this;
                var credentials = this.credentials;
                var remember = false;

                loading.show();
                event.fire('auth.authenticating', credentials);

                auth.attempt(credentials, [], remember).then(function (token, user, roles) {
                    auth.saveToken(token);

                    event.fire('auth.authenticated', {token: token, user: user, roles: roles});
                    
                    redirect.toDashboard();
                }, function (message) {
                    that.error = message;

                    event.fire('auth.failed', message);

                    loading.hide();
                });
            },

            clearError() {
                this.error = '';
            }
        },

        ready() {
            loading.setApp(this.$root);
            event.setApp(this.$root);
        }
    }
</script>