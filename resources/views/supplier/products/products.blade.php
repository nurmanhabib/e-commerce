@extends('layouts.supplier')

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
	<products></products>
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js') }}"></script>
@stop