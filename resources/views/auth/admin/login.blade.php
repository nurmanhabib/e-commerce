@extends('layouts.login')

@section('content')
	<form id="login">
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
				<h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input v-model="credentials.email" type="email" class="form-control" placeholder="Email">
				<div class="form-control-feedback">
					<i class="icon-user text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input v-model="credentials.password" type="text" class="form-control" placeholder="Password">
				<div class="form-control-feedback">
					<i class="icon-lock2 text-muted"></i>
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
						<a href="login_password_recover.html">Forgot password?</a>
					</div>
				</div>
			</div>

			<div class="form-group">
				<button v-on:click="loginAdmin" type="button" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
			</div>		
		</div>
	</form>
@stop

@section('script')
	<script src="{{ asset('vue/auth/login-admin.js') }}"></script>
@stop