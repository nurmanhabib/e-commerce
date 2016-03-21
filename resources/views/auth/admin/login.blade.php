@extends('layouts.login')

@section('content')
	<login></login>
@stop

@section('scripts')
    <script src="{{ asset('app/admin/build.js') }}"></script>
@stop