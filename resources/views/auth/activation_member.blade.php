@extends('layouts.login')

@section('content')
	<form id="register" v-on:submit.prevent="activateAccount">
		<input type="hidden" v-model="activation_code" value="{{ $activation_code }}">
		<div class="panel panel-body login-form">
			<div class="text-center">
				<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
				<h5 class="content-group">Complete Registration <small class="display-block">All fields are required</small></h5>
			</div>

			<div v-show="error" class="alert alert-danger alert-styled-left alert-bordered">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
				<span class="text-semibold">@{{ error }}</span>
		    </div>

		    <div v-if="registration_status == 'success'">
			    <div class="text-center">
					<h5 class="content-group">Your registration is successfully 
					<small class="display-block">Click button below to login your accout</small></h5>
				</div>
				<div class="form-group">
					<button v-on:click="login" type="button" class="btn bg-blue btn-block">
						Login <i class="icon-arrow-right14 position-right"></i>
					</button>
				</div>
		    </div>

		    <div v-else>
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
					<input v-model="address.address_line_1" maxlength="100" placeholder="Address 1" type="text" class="form-control">
					<div class="form-control-feedback">
						<i class="icon-location3 text-muted"></i>
					</div>
				</div>

				<div class="form-group has-feedback has-feedback-left">
					<input v-model="address.address_line_2" maxlength="200" placeholder="Address 2" type="text" class="form-control">
					<div class="form-control-feedback">
						<i class="icon-location3 text-muted"></i>
					</div>
				</div>

				<div class="form-group has-feedback has-feedback-left">
					<input v-model="address.phone" type="text" class="form-control" placeholder="Phone">
					<div class="form-control-feedback">
						<i class="icon-phone2 text-muted"></i>
					</div>
				</div>

				<div class="form-group has-feedback has-feedback-left">
					<input v-model="password" type="password" minlength="8" class="form-control" placeholder="Password">
					<div class="form-control-feedback">
						<i class="icon-lock2 text-muted"></i>
					</div>
				</div>
				
				<div class="from-group">
					<button type="submit" class="btn bg-teal btn-block btn-lg">
						Submit <i class="icon-circle-right2 position-right"></i>
					</button>
				</div>
		    </div>
		</div>
	</form>
@stop

@section('script')
	<script src="{{ asset('vue/auth/register.js') }}"></script>
@stop