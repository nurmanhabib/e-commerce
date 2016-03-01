@extends('layouts.front')

@section('scripts')
    <script src="{{ asset('facebook.js') }}"></script>
@stop

@section('content')
    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button>

    <div id="status">
    </div>
    <img src="" alt="" id="avatar">
@stop