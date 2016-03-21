<!-- start:header main -->
<section id="header-main">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="{{ asset('assets/images/slider.jpg') }}">
				<div class="carousel-caption">
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<div class="content-caption">
							<h1>The World's Leading Platform for Global Trade</h1>
							<button class="btn btn-lg btn-caption" type="button">Learn More</button>
						</div>
					</div>
				</div>
			</div>

			<div class="item">
				<img src="{{ asset('assets/images/slider.jpg') }}">
				<div class="carousel-caption">
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="content-caption">
							<h1>The World's Leading Platform for Global Trade</h1>
							<button class="btn btn-lg btn-caption" type="button">Learn More</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</section>
<!-- end:/header-main -->