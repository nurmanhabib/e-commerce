<style>
    
</style>

<template>    
    <form id="login" v-on:submit.prevent="login()">
        <div class="panel panel-body login-form">
            <div class="text-center">
                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                <h5 class="content-group">Login to Supplier account <small class="display-block">Your credentials</small></h5>
            </div>

            <div v-if="error" class="alert alert-danger alert-styled-left alert-bordered">
                <button v-on:click="clearError()" type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">@{{ error }}</span>
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
                            <input v-model="credentials.remember" type="checkbox" class="styled">
                            Remember
                        </label>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a v-on:click="forgotPassword">Forgot password?</a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn bg-blue btn-block btn-ladda btn-ladda-progress" data-style="zoom-out">Login <i class="icon-arrow-right14 position-right"></i></button>
            </div>

            <div class="content-divider text-muted form-group"><span>or sign in with</span></div>
            <ul class="list-inline form-group list-inline-condensed text-center">
                <li><a href="#" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>
                <li><a href="#" class="btn border-pink-300 text-pink-300 btn-flat btn-icon btn-rounded"><i class="icon-dribbble3"></i></a></li>
                <li><a href="#" class="btn border-slate-600 text-slate-600 btn-flat btn-icon btn-rounded"><i class="icon-github"></i></a></li>
                <li><a href="#" class="btn border-info text-info btn-flat btn-icon btn-rounded"><i class="icon-twitter"></i></a></li>
            </ul>

            <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
            <a v-on:click="signUp" class="btn bg-teal btn-block content-group">Create Account</a>
            <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
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

                auth.attempt(credentials, 'supplier', remember).then(function (token, user, roles) {
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