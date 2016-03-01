<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amtek eCommerce</title>

    @yield('styles')
</head>
<body>
	<div id="app">
    	<loading></loading>
    	<content>
    		@yield('content')
			<button v-on:click="loading('show')">Loading</button>
			<button v-on:click="loading('hide')">Stop Loading</button>
		</content>
	</div>

	<script src="{{ asset('build.js') }}"></script>
    @yield('scripts')
</body>
</html>