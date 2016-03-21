<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>AmetkCommerce</title>
        <!-- start:stylesheet -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('stylesheets/app.css') }}">
        <!-- end:/stylesheet -->
    </head>
    <body>
        <!-- start:header -->
        <header id="header">
            <!-- start:navbar-main -->
            <section id="navbar-main">
                <nav class="navbar">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="#">
                                <img src="{{ asset('assets/images/icon/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                </nav>
            </section>
            <!-- end:/navbar-main -->
        </header>
        <!-- end:/header -->

        <!-- start:main content -->
        <section id="content-login">
            <!-- start:content-login -->
            <div class="container">
                <div class="login-box">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="login-left">
                                <div class="login-left-content">
                                    <h3>Ilustrator for Login</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="login-right">
                                <div class="login-top-right">
                                
                                    <login></login>

                                </div>
                                <div class="login-bottom-right">
                                    <p>Login with Social Media :</p>
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-google-plus-square"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end:/content-login -->
        </section>
        <!-- end:/main content -->

        <!-- start:footer -->
        <footer class="footer">
            @include('front.include.footer')
        </footer>
        <!-- end:/footer -->

        <!-- start:javascript -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        @yield('scripts')
        <!-- end:/javascript -->
    </body>
</html>