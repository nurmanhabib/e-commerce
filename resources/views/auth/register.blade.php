@extends('layouts.login')

@section('content')
	<form id="register">
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
				<h5 class="content-group">Create account <small class="display-block">All fields are required</small></h5>
			</div>

			<div v-show="error" class="alert alert-danger alert-styled-left alert-bordered">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
				<span class="text-semibold">@{{ error }}</span>
		    </div>

		    <div class="form-group has-feedback has-feedback-left">
				<input v-model="profile.first_name" type="text" class="form-control" placeholder="First name">
				<div class="form-control-feedback">
					<i class="icon-user-check text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input v-model="profile.last_name" type="text" class="form-control" placeholder="Last name">
				<div class="form-control-feedback">
					<i class="icon-user-check text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback has-feedback-left">
                <select v-model="profile.gender" name="select" class="form-control">
                    <option selected>--- Gender ---</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
				<div class="form-control-feedback">
					<i class="icon-user-check text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input v-model="email" type="email" class="form-control" placeholder="Email">
				<div class="form-control-feedback">
					<i class="icon-mail5 text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input v-model="password" type="password" minlength="8" class="form-control" placeholder="Password">
				<div class="form-control-feedback">
					<i class="icon-lock2 text-muted"></i>
				</div>
			</div>
			
			<div class="from-group">
				<button v-on:click="registerMember" type="button" class="btn bg-teal btn-block btn-lg">Register <i class="icon-circle-right2 position-right"></i></button>
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