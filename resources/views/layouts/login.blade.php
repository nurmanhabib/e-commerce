<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Amtek-Commerce</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('app/admin/css/loading.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/extras/animate.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

</head>

<body class="login-cover">
    <div id="app">
        <loading>
            <div class="loading">
                <div class="loader">Loading...</div>
            </div>
        </loading>

        <content style="display: none;">
			<!-- Main navbar -->
			<div class="navbar navbar-inverse">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">
						<img src="{{ asset('assets/images/logo_light.png') }}" alt="">
					</a>

					<ul class="nav navbar-nav pull-right visible-xs-block">
						<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
					</ul>
				</div>
			</div>
			<!-- /main navbar -->


			<!-- Page container -->
			<div class="page-container login-container">

				<!-- Page content -->
				<div class="page-content">

					<!-- Main content -->
					<div class="content-wrapper">

						<!-- Content area -->
						<div class="content">

							<!-- Form login -->
							@yield('content')
							<!-- /Form login -->


							<!-- Footer -->
							<div class="footer text-white">
								&copy; 2016. <a href="#" class="text-white">Amtek-Commerce</a> by <a href="http://amteklab.com" class="text-white" target="_blank">Amteklab</a>
							</div>
							<!-- /footer -->

						</div>
						<!-- /content area -->

					</div>
					<!-- /main content -->

				</div>
				<!-- /page content -->

			</div>
			<!-- /page container -->
		</content>
	</div>

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/velocity/velocity.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/velocity/velocity.ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/buttons/spin.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/buttons/ladda.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/login.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_buttons.js') }}"></script>
	<!-- /theme JS files -->
	
    <!-- Build Core -->
    <script src="{{ asset('app/admin/build.js') }}"></script>
    <!-- /Build Core -->

	<!-- Vue JS -->
	<script src="{{ asset('node_modules/vue/dist/vue.min.js') }}"></script>
	<script src="{{ asset('node_modules/vue-resource/dist/vue-resource.min.js') }}" ></script>
	<script src="{{ asset('node_modules/vue-validator/dist/vue-validator.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('vue/cookies.js') }}"></script>
	<script src="{{ asset('vue/http.js') }}"></script>
	<!-- /Vue JS -->
	
	@yield('script')


</body>
</html>
