@extends('layouts.login')

@section('content')
	<login></login>
@stop

@section('build_core')
    <script src="{{ asset('app/admin/build.js') }}"></script>
@stop