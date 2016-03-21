<nav class="navbar">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">
				<img src="{{ asset('assets/images/icon/logo.png') }}" alt="">
			</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<div class="navbar-right">
				<div class="dropdown avatar pull-right">
                    <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('assets/images/avatar.png') }}" alt="">
                    </a>
                </div>
                <div class="cart pull-right">
					<a href="#collapseChart" data-toggle="collapse">
						<img src="{{ asset('assets/images/icon/chart.svg') }}" alt="">
						<p>3</p>
					</a>
					
				</div>
			</div>
		</div>
	</div>
</nav>