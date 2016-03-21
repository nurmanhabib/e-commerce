@extends('layouts.login')

@section('content')
	<login></login>
@stop

@section('scripts')
    <script src="{{ asset('app/supplier/build.js') }}"></script>
@stop
