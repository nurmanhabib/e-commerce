<style>
    
</style>

<template>    
    <form id="login" v-on:submit.prevent="login()">
        <div class="panel panel-body login-form">
            <div class="text-center">
                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
            </div>

            <div v-if="error" class="alert alert-danger alert-styled-left alert-bordered">
                <button v-on:click="clearError()" type="button" class="close"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ error }}</span>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input v-model="credentials.email" type="email" class="form-control" placeholder="Email">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input v-model="credentials.password" type="password" class="form-control" placeholder="Password">
                <div class="form-control-feedback">
                    <i class="icon-lock2 text-muted"></i>
                </div>
            </div>

            <div class="form-group login-options">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="checkbox-inline">
                            <input v-model="remember" type="checkbox" class="styled">
                            Remember
                        </label>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a v-on:click="">Forgot password?</a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
            </div>      
        </div>
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

                auth.attempt(credentials, 'admin', remember).then(function (token, user, roles) {
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