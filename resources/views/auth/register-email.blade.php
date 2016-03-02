@extends('layouts.login')

@section('content')
	<form id="register" v-on:submit.prevent="registerOnlyEmail">
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
				<h5 class="content-group">Register account <small class="display-block">Email is required</small></h5>
			</div>

		    <div v-if="message !== '' || error !== ''">
				<div v-if="status == 'success'" class="alert alert-success alert-styled-left alert-bordered">
				  	<button v-on:click="clearMessage" type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">@{{ message }}</span>
				</div>
				<div v-if="status == 'failed'" class="alert alert-danger alert-styled-left alert-bordered">
				  	<button v-on:click="clearMessage" type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">@{{ message }}</span>
				</div>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input v-model="email" type="email" class="form-control" placeholder="Email">
				<div class="form-control-feedback">
					<i class="icon-mail5 text-muted"></i>
				</div>
			</div>
			
			<div class="from-group">
				<button type="submit" class="btn bg-teal btn-block btn-lg">Register <i class="icon-circle-right2 position-right"></i></button>
			</div><br>

			<div class="content-divider text-muted form-group"><span>or create account with</span></div>
			<ul class="list-inline form-group list-inline-condensed text-center">
				<li><a href="#" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>
				<li><a href="#" class="btn border-pink-300 text-pink-300 btn-flat btn-icon btn-rounded"><i class="icon-dribbble3"></i></a></li>
				<li><a href="#" class="btn border-slate-600 text-slate-600 btn-flat btn-icon btn-rounded"><i class="icon-github"></i></a></li>
				<li><a href="#" class="btn border-info text-info btn-flat btn-icon btn-rounded"><i class="icon-twitter"></i></a></li>
			</ul>
		</div>
	</form>
@stop

@section('script')
	<script src="{{ asset('vue/auth/register.js') }}"></script>
@stop