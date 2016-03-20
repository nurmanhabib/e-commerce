@extends('layouts.login')

@section('content')
	<login></login>
@stop

@section('build_core')
    <script src="{{ asset('app/supplier/build.js') }}"></script>
@stop
