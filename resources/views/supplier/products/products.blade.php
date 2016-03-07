@extends('layouts.admin')

@section('header')
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Products</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="#"><i class="icon-home2 position-left"></i> Home</a></li>
				<li class="active">Products</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->
@stop

@section('content')
	<div id="products">		

		<div class="panel panel-flat">
			<div class="panel-heading">
				<legend class="text-bold panel-title">Products</legend>
			</div>
			<div class="panel-body">
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"><i class="icon-plus22 position-right"></i> Add Product</button>
				<table class="table datatable-basic">
					<thead>
						<tr>
							<th><strong>Code</strong></th>
							<th><strong>Product Name</strong></th>
							<th><strong>Description</strong></th>
							<th><strong>Price</strong></th>
							<th class="text-center"><strong>Actions</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="product in products">
							<td>@{{ product.code }}</td>
							<td>@{{ product.name }}</td>
							<td>@{{ product.description }}</td>
							<td>@{{ product.price }}</td>
							<td class="text-center">
								<a v-on:click="editProducts(product)" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal_edit" data-popup="tooltip" title="" data-original-title="Edit" title="Edit"><i class="fa fa-pencil"></i></a>
								<a v-on:click="deleteProducts(product.id)" class="btn btn-default btn-xs" data-popup="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Modal Add Products -->
		<div id="modal_add" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Add Product</h3>
					</div>

					<div class="modal-body">
						<form class="form-horizontal" v-on:submit.prevent="addProducts">
							<fieldset class="content-group">
								
								<div class="form-group">
			                    	<label class="control-label col-lg-4">Code</label>
									<div class="col-lg-8">
										<input v-model="newProducts.code" required type="text" class="form-control">
									</div>
			                    </div>

			                    <div class="form-group">
			                    	<label class="control-label col-lg-4">Category</label>
			                    	<div class="col-lg-8">
			                            <select v-model="newProducts.category_id" required name="select" class="form-control">
			                                <option value="" selected>--- None ---</option>
			                                <option v-for="category in categories" value="@{{ category.id }}">@{{ category.name }}</option>
			                            </select>
			                        </div>
			                    </div>

								<div class="form-group">
									<label class="control-label col-lg-4">Products Name</label>
									<div class="col-lg-8">
										<input v-model="newProducts.name" required type="text" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4">Price</label>
									<div class="col-lg-8">
										<input v-model="newProducts.price" required type="text" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4">Description</label>
									<div class="col-lg-8">
										<textarea v-model="newProducts.description" required class="form-control" rows="5" cols="5"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4">Tags</label>
									<div class="col-lg-8">
										<input v-model="newProducts.tags" type="text" class="form-control">
									</div>
								</div>

							</fieldset>

							<div class="pull-right">
								<button type="reset" class="btn btn-default">Reset</button>
								<button type="submit" class="btn btn-primary">Add Products</button>
							</div>
						</form>
					</div>

					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal Add Products -->

		<!-- Modal Edit Products -->
		<div id="modal_edit" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" v-on:click="cancelEdit" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Edit Products</h3>
					</div>

					<div class="modal-body">
						<form class="form-horizontal" v-on:submit.prevent="updateProducts(edit.id)">
							<fieldset class="content-group">
								
								<div class="form-group">
			                    	<label class="control-label col-lg-4">Code</label>
									<div class="col-lg-8">
										<input v-model="edit.code" required type="text" class="form-control">
									</div>
			                    </div>

			                    <div class="form-group">
			                    	<label class="control-label col-lg-4">Category</label>
			                    	<div class="col-lg-8">
			                            <select v-model="edit.category_id" required name="select" class="form-control">
			                                <option value="" selected>--- None ---</option>
			                                <option v-for="category in categories" value="@{{ category.id }}">@{{ category.name }}</option>
			                            </select>
			                        </div>
			                    </div>

								<div class="form-group">
									<label class="control-label col-lg-4">Products Name</label>
									<div class="col-lg-8">
										<input v-model="edit.name" required type="text" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4">Price</label>
									<div class="col-lg-8">
										<input v-model="edit.price" required type="text" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4">Description</label>
									<div class="col-lg-8">
										<textarea v-model="edit.description" required class="form-control" rows="5" cols="5"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4">Tags</label>
									<div class="col-lg-8">
										<input v-model="edit.tags" type="text" class="form-control">
									</div>
								</div>

							</fieldset>

							<div class="pull-right">
								<button type="reset" class="btn btn-default">Reset</button>
								<button type="submit" class="btn btn-primary">Update Products</button>
							</div>	

						</form>
					</div>

					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal Add Products -->

	</div>
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('vue/app/admin/products/products.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js') }}"></script>
@stop