@extends('layouts.login')

@section('content')
	<form id="login">
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
				<h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
			</div>
			
			@{{error}}

			<div class="form-group has-feedback has-feedback-left">
				<input v-model="credentials.email" type="email" class="form-control" placeholder="Email">
				<div class="form-control-feedback">
					<i class="icon-user text-muted"></i>
				</div>
			</div>

			<div class="form-group login-options">
				<div class="row">
					<div class="col-sm-6">
						<label class="checkbox-inline">
							<input type="checkbox" class="styled" checked="checked">
							Remember
						</label>
					</div>

					<div class="col-sm-6 text-right">
						<a v-on:click="forgotPassword">Forgot password?</a>
					</div>
				</div>
			</div>

			<div class="form-group">
				<button v-on:click="loginUser" type="button" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
			</div>

			<div class="content-divider text-muted form-group"><span>or sign in with</span></div>
			<ul class="list-inline form-group list-inline-condensed text-center">
				<li><a href="#" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>
				<li><a href="#" class="btn border-pink-300 text-pink-300 btn-flat btn-icon btn-rounded"><i class="icon-dribbble3"></i></a></li>
				<li><a href="#" class="btn border-slate-600 text-slate-600 btn-flat btn-icon btn-rounded"><i class="icon-github"></i></a></li>
				<li><a href="#" class="btn border-info text-info btn-flat btn-icon btn-rounded"><i class="icon-twitter"></i></a></li>
			</ul>

			<div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
			<a href="login_registration.html" class="btn btn-default btn-block content-group">Sign up</a>
			<span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
		</div>
	</form>
@stop

@section('script')
	<script src="{{ asset('vue/auth/login-user.js') }}"></script>
@stop