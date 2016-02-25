@extends('layouts.admin')

@section('header')
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Category</span></h4>
			</div>
		</div>

		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
				<li class="active">Category</li>
			</ul>
		</div>
	</div>
	<!-- /page header -->
@stop

@section('content')
	<div id="category">		

		<div class="panel panel-flat">
			<div class="panel-heading">
				<legend class="text-bold panel-title">Category</legend>
			</div>
			<div class="panel-body">
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_default"><i class="icon-plus22 position-right"></i> Add Category</button>
				<table class="table datatable-basic">
					<thead>
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Slug</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="category in categories">
							<td>@{{ category.id }}</td>
							<td>@{{ category.name }}</td>
							<td>@{{ category.slug }}</td>
							<td class="text-center">
								<a href="#" data-popup="tooltip" title="" data-original-title="Edit" title="edit"><i class="icon-pencil7"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Basic modal -->
		<div id="modal_default" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Add Category</h3>
					</div>

					<div class="modal-body">
						<form class="form-horizontal" action="#">
							<fieldset class="content-group">
								
								<div class="form-group">
			                    	<label class="control-label col-lg-4">Parent Category</label>

			                    	<div class="col-lg-8">

			                            <select v-model="newcategory.parent" name="select" class="form-control">
			                                <option value="0" selected>-- None --</option>
			                                <option v-for="parent in categories" value="@{{ parent.id }}">@{{ parent.name }}</option>
			                            </select>
			                        </div>
			                    </div>

								<div class="form-group">
									<label class="control-label col-lg-4">Category</label>
									<div class="col-lg-8">
										<input v-model="newcategory.name" type="text" class="form-control">
									</div>
								</div>
							</fieldset>
						</form>
					</div>

					<div class="modal-footer">
						<button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
						<button v-on:click="createCategory" type="button" class="btn btn-primary">Add Category</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /basic modal -->

	</div>
@stop

@section('scripts')
	<script src="{{ asset('vue/app/admin/category/category.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js') }}"></script>
@stop