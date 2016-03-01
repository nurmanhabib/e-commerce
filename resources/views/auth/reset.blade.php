@extends('layouts.login')

@section('content')
	<form v-on:submit.prevent="resetPassword" id="reset-password">
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
				<h5 class="content-group">Password recovery <small class="display-block">Please enter your new password</small></h5>
			</div>

			<div v-if="message !== ''">
				<div class="alert alert-danger alert-styled-left alert-bordered">
				  	<button v-on:click="clearMessage" type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">@{{ message }}</span>
				</div>
			</div>

			<div class="form-group has-feedback">
				<input type="email" class="form-control" v-model="email" placeholder="Your email">
				<div class="form-control-feedback">
					<i class="icon-mail5 text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback">
				<input type="password" class="form-control" id="password" v-model="password" placeholder="Your new password">
				<div class="form-control-feedback">
					<i class="icon-lock2 text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback">
				<input type="password" class="form-control" id="password_confirmation" v-model="password_confirmation" placeholder="Confirmation new password">
				<div class="form-control-feedback">
					<i class="icon-lock2 text-muted"></i>
				</div>
			</div>

			<button type="submit" class="btn bg-blue btn-block">Change password <i class="icon-arrow-right14 position-right"></i></button>
		</div>
	</form>
@stop

@section('script')
	<script src="{{ asset('vue/auth/reset-password.js') }}"></script>
@stop