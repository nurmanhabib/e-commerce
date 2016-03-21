@extends('layouts.front-homepage')

@section('styles')  
    <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheets/slick-custom.css') }}">
@stop

@section('content')    
	<!-- start:popular-supplier -->
	<div class="popular-supplier">
		<div class="container">
			<div class="popular-supplier-title">
                <div class="text-center">
                    <h4>Popular Suppliers</h4>
                </div>
            </div>
        	<div class="container">
        		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="content-popular-supplier">
						<a href="#" class="thumbnail">
							<img src="../assets/images/1.jpg" alt="">
							<div class="price">
								<p>IDR 300.000,-</p>
								<h4>Batik popular masa kini dan masa akan datang</h4>
							</div>
						</a>
					</div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                	<div class="content-popular-supplier">
						<a href="#" class="thumbnail">
							<img src="../assets/images/1.jpg" alt="">
							<div class="price">
								<p>IDR 300.000,-</p>
								<h4>Batik popular masa kini dan masa akan datang</h4>
							</div>
						</a>
					</div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                	<div class="content-popular-supplier">
						<a href="#" class="thumbnail">
							<img src="../assets/images/1.jpg" alt="">
							<div class="price">
								<p>IDR 300.000,-</p>
								<h4>Batik popular masa kini dan masa akan datang</h4>
							</div>
						</a>
					</div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                	<div class="content-popular-supplier">
						<a href="#" class="thumbnail">
							<img src="../assets/images/1.jpg" alt="">
							<div class="price">
								<p>IDR 300.000,-</p>
								<h4>Batik popular masa kini dan masa akan datang</h4>
							</div>
						</a>
					</div>
                </div>
        	</div>
        	<div class="text-center">
        		<a href="" class="btn btn-link btn-see-all">See All</a>
        	</div>
        </div>
	</div>
	<!-- end:/popular-supplier -->

	<!-- start:hot-product -->			
	<div class="hot-product">					
        <div class="container">
        	<div class="hot-product-title">
        		<img src="../assets/images/icon/bookmark.svg" alt="">
        		<h4>Hot Products</h4>
        	</div>

        	<div class="slick-hot-product">
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab.jpg" alt=""></a></h3>
			    </div>
			</div>
        </div>
	</div>
	<!-- end:/hot-product -->

	<!-- start:popular-product -->
	<div class="popular-product">
		<div class="container">
			<div class="popular-product-title">
				<img src="../assets/images/icon/bookmark.svg" alt="">
            	<h4>Popular Products</h4>
            </div>

        	<div class="slick-popular-product">
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab2.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab2.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab2.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab2.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab2.jpg" alt=""></a></h3>
			    </div>
			    <div>
				    <h3><a href="#"><img src="../assets/images/hijab2.jpg" alt=""></a></h3>
			    </div>
			</div>
        </div>
	</div>
	<!-- end:/popular-product -->
@stop

@section('scripts')
    <script src="{{ asset('bower_components/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('javascript/slick-homepage.js') }}"></script>
@stop