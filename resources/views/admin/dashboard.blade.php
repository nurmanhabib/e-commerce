@extends('layouts.admin')

@section('content')
    <h1>Control Panel - Amtek Ecommerce v1.0.0</h1>
    <div id="admin">
    	isi
    </div>
@stop

@section('scripts')
	<script>
		new Vue({
			el: '#admin',
			ready: function(){
				console.log(localStorage.getItem('auth'))
			}
		})
	</script>
@stop