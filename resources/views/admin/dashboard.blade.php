@extends('layouts.admin')

@section('header')
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="index.html">Home</a></li>
                <li class="active">Dashboard</li>
            </ul>
        </div>
    </div>
@stop

@section('content')
    <h1>Control Panel - Amtek Ecommerce v1.0.0</h1>
    <div id="admin">
    	<dashboard></dashboard>
    </div>
@stop