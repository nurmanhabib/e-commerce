@extends('layouts.login')

@section('content')
					<!-- Registration form -->
					<div id="register" class="panel panel-white col-lg-6 col-lg-offset-3">
					    <div v-if="registration_status == 'success'">
							<div class="text-center">
								<div class="icon-object border-success text-success"><i class="icon-checkmark4"></i></div>
								<h5 class="content-group">
									Your registration is successfully 
									<small class="display-block">Click button below to login your accout</small>
								</h5>
							</div>
							<div class="form-group">
								<button v-on:click="loginSupplier" type="button" class="btn bg-blue btn-block">
									Login <i class="icon-arrow-right14 position-right"></i>
								</button>
							</div>
					    </div>

					    <div v-else>
							<div class="panel-heading">
								<div class="text-center">
									<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
									<h5 class="content-group-lg">Create account <small class="display-block">All fields are required</small></h5>
								</div>
							</div>

							<div v-show="error" class="alert alert-danger alert-styled-left alert-bordered">
								<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
								<span class="text-semibold">@{{ error }}</span>
						    </div>

		                	<form class="stepy-basic" v-on:submit.prevent="activateSupplier">
								<input type="hidden" v-model="activation_code" value="{{ $activation_code }}">
								<fieldset title="1">
									<legend class="text-semibold">Supplier Profile 1</legend>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Name Supplier:</label>
												<input type="text" v-model="supplier.name" class="form-control" placeholder="Name Supplier"></input>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Address 1 :</label>
												<textarea type="text" v-model="supplier.address1" class="form-control" cols="5" rows="3" placeholder="Address 1"></textarea>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Address 2 :</label>
												<textarea type="text" v-model="supplier.address2" class="form-control" cols="5" rows="3" placeholder="Address 2"></textarea>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Phone 1 :</label>
												<input type="text" v-model="supplier.phone1" class="form-control" placeholder="Phone 1"></input>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Phone 2 :</label>
												<input type="text" v-model="supplier.phone2" class="form-control" placeholder="Phone 2"></input>
											</div>
										</div>
									</div>
								</fieldset>

								<fieldset title="2">
									<legend class="text-semibold">Supplier Profile 2</legend>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Website :</label>
												<input type="text" v-model="supplier.website" class="form-control" placeholder="Website"></input>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Email :</label>
												<input type="email" v-model="supplier.email" class="form-control" placeholder="Email"></input>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Tags :</label>
												<input type="text" v-model="supplier.tags" class="form-control" placeholder="Tags"></input>
											</div>
										</div>
									</div>
								</fieldset>

								<fieldset title="3">
									<legend class="text-semibold">Owner Profile</legend>

									<div class="row">
										<div class="col-md-8 col-lg-offset-2">
											<div class="form-group">
												<label>First Name :</label>
												<input type="text" v-model="profile.first_name" class="form-control" placeholder="First Name"></input>
											</div>
										</div>

										<div class="col-md-8 col-lg-offset-2">
											<div class="form-group">
												<label>Last Name :</label>
												<input type="text" v-model="profile.last_name" class="form-control" placeholder="Last Name"></input>
											</div>
										</div>

										<div class="col-md-8 col-lg-offset-2">
											<div class="form-group">
												<label class="display-block text-semibold">Gender :</label>
												<label class="radio-inline">
													<input type="radio" v-model="profile.gender" value="male" name="radio-unstyled-inline-left" checked="checked">
													Male
												</label>

												<label class="radio-inline">
													<input type="radio" v-model="profile.gender" value="female" name="radio-unstyled-inline-left">
													Female
												</label>
											</div>
										</div>
									</div>
								</fieldset>

								<fieldset title="4">
									<legend class="text-semibold">Account Password</legend>

									<div class="row">
										<div class="col-md-6 col-lg-offset-3">
											<div class="form-group">
												<label>Password :</label>
												<input type="password" v-model="password" class="form-control" minlength="10" placeholder="Password"></input>
											</div>
										</div>
									</div>
								</fieldset>

								<button type="submit" class="btn btn-primary stepy-finish">
									Submit <i class="icon-check position-right"></i>
								</button>
							</form>
						</div>
		            </div>
					<!-- /registration form -->
@stop

@section('script')
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/wizards/stepy.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/wizard_stepy.js') }}"></script>
	<script src="{{ asset('vue/auth/register.js') }}"></script>
@stop