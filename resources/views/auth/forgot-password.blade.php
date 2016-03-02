@extends('layouts.login')

@section('content')
	<form v-on:submit.prevent="forgotPassword" id="forgot-password">
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
				<h5 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h5>
			</div>

			<div v-if="message !== ''">
				<div v-if="status == 'success'" class="alert alert-success alert-styled-left alert-bordered">
				  	<button v-on:click="clearMessage" type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">@{{ message }}</span>
				</div>
				<div v-if="status == 'failed'" class="alert alert-danger alert-styled-left alert-bordered">
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

			<button type="submit" class="btn bg-blue btn-block">
				Reset password <i class="icon-arrow-right14 position-right"></i>
			</button>

		</div>
	</form>
@stop

@section('script')
	<script src="{{ asset('vue/auth/forgot-password.js') }}"></script>
@stop