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
	<category></category>
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js') }}"></script>
@stop