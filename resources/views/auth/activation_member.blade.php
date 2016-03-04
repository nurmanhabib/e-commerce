@extends('layouts.login')

@section('content')
<div id="register">
	<validator name="validation">
		<form v-on:submit.prevent="activateMember">
			<input type="hidden" v-model="activation_code" value="{{ $activation_code }}">
			<div class="panel panel-body login-form">

			    <div v-if="registration_status == 'success'">
				    <div class="text-center">
				    	<div class="icon-object border-success text-success"><i class="icon-checkmark4"></i></div>
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
				    <div class="text-center">
						<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
						<h5 class="content-group">Complete Registration <small class="display-block">All fields are required</small></h5>
					</div>

					<div v-show="error" class="alert alert-danger alert-styled-left alert-bordered">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">@{{ error }}</span>
				    </div>

			    	<div class="form-group has-feedback has-feedback-left">
						<input v-model="profile.first_name" type="text" required class="form-control" placeholder="First name">
						<div class="form-control-feedback">
							<i class="icon-user-check text-muted"></i>
						</div>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input v-model="profile.last_name" type="text" required class="form-control" placeholder="Last name">
						<div class="form-control-feedback">
							<i class="icon-user-check text-muted"></i>
						</div>
					</div>

					<div class="form-group has-feedback has-feedback-left">
		                <select v-model="profile.gender" required name="select" class="form-control">
		                    <option selected value="">--- Gender ---</option>
		                    <option value="male">Male</option>
		                    <option value="female">Female</option>
		                </select>
						<div class="form-control-feedback">
							<i class="icon-user-check text-muted"></i>
						</div>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input v-model="address.address_line_1" maxlength="100" required placeholder="Address 1" type="text" class="form-control">
						<div class="form-control-feedback">
							<i class="icon-location3 text-muted"></i>
						</div>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input v-model="address.address_line_2" maxlength="200" required placeholder="Address 2" type="text" class="form-control">
						<div class="form-control-feedback">
							<i class="icon-location3 text-muted"></i>
						</div>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input v-model="address.phone" type="text" maxlength="14" class="form-control" placeholder="Phone">
						<div class="form-control-feedback">
							<i class="icon-phone2 text-muted"></i>
						</div>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input v-model="password" type="password" pattern=".{10,}" required title="10 characters minimum" class="form-control" placeholder="Password">
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
	</validator>
</div>
@stop

@section('script')
	<script src="{{ asset('vue/auth/register.js') }}"></script>
@stop