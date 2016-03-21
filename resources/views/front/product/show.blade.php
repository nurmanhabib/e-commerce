@extends('layouts.front')

@section('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheets/slick-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/bootstrap-star-rating/css/star-rating.css') }}">
@stop

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
        <!-- start:main-content -->
        <div class="main-content">
            <div class="row">
                <div class="content-detail">
                    <div class="col-lg-12">
                        <div class="heading-detail-product">
                            <h3>Busana Wanita</h3>
                            <input id="input-1-ltr-star-xs" class="kv-ltr-theme-fa-star rating-loading" value="0" dir="ltr" data-size="xs">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="content-detail-product">
                            <!-- start:detail image -->
                            <div class="slider slider-for">
                                <div>
                                    <img src="{{ asset('assets/images/hijab.jpg') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('assets/images/hijab.jpg') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('assets/images/1.jpg') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('assets/images/hijab.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="slider center">
                                <div>
                                    <img src="{{ asset('assets/images/hijab.jpg') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('assets/images/hijab.jpg') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('assets/images/1.jpg') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('assets/images/hijab.jpg') }}" alt="">
                                </div>
                            </div>
                            <!-- end:/detail image -->

                            <!-- start:detail item and comment -->
                            <div class="detail-comment">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#detail" aria-controls="Detail Item" role="tab" data-toggle="tab">About Item</a>
                                    </li>
                                    <li>
                                        <a href="#comment" aria-controls="Detail Item" role="tab" data-toggle="tab">Comment</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="detail">...</div>
                                    <div role="tabpanel" class="tab-pane" id="coment">...</div>
                                </div>
                            </div>
                            <!-- end:/detail item and comment -->
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <!-- start:sidebar -->
                        <div class="sidebar">
                            <div class="widget">
                                <!-- start:widget-detail-product -->
                                <div class="widget-detail-product">
                                    <div class="price">
                                        <h4>Price: </h4>
                                        <h3>IDR 3.000.000,-</h3>
                                        <h5><small>Last updated Price 21 March 2016, 12:30PM</small></h5>
                                    </div>
                                    <div class="stock">
                                        <h5>Stock : </h5>
                                        <h4><span class="label label-default">300 Pcs</span></h4>
                                    </div>
                                    <div class="count">
                                        <h5>Count :</h5>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="text" class="form-control" value="1">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- end:/widget-detail-product -->
                                <a href="#" class="btn btn-basic btn-block">Buy</a>
                                <a href="#" class="btn btn-primary btn-block"><i class="fa fa-cart-arrow-down"></i> Add to cart</a>

                                <!-- start:widget-supplier -->
                                <div class="widget-supplier">
                                    <div class="widget-supplier-heading">
                                        <h4>Porfile Supplier</h4>
                                    </div>
                                    <div class="widget-supplier-content">
                                        <img src="{{ asset('assets/images/hijab2.jpg') }}" alt="">
                                        <div class="supplier-profile">
                                            <h5><a href="#">Ammteklab Supplier</a></h5>
                                            <h5><i class="fa fa-map-marker"></i> Yogyakarta</h5>
                                            <a href="#" class="btn btn-primary btn-block"><i class="fa fa-heart"></i> Favorite</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end:/widget-supplier -->
                            </div>
                        </div>
                        <!-- end:/sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end:/main-content -->
    </div>
@stop

@section('scripts')
    <script src="{{ asset('bower_components/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap-star-rating/js/star-rating.js') }}"></script>
    <script>
        $(document).on('ready', function(){
            $('.kv-ltr-theme-fa-star').rating({
                hoverOnClear: false,
                theme: 'krajee-fa',
                filledStar: '<i class="fa fa-star"></i>',
                emptyStar: '<i class="fa fa-star-o"></i>'
            });
        });
    </script>
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.center'
        });
        $('.center').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.slider-for',
            dots: true,
            centerMode: true,
            focusOnSelect: true
        });
    </script>
@stop