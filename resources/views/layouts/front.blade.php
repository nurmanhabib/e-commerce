<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title>AmtekCommerce</title>

        <!-- start:stylesheet -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('stylesheets/app.css') }}">

        @yield('styles')
        <!-- end:/stylesheet -->
    </head>
    <body>
        <div id="app">
            <loading>
                <div class="loading">
                    <div class="loader">Loading...</div>
                </div>
            </loading>

            <content style="display: none;">
                <!-- start:header -->
                <header id="header">
                    <!-- start:navbar-main -->
                    <section id="navbar-main">
                        @include('front.include.header-top')
                        @include('front.include.header-cart')
                    </section>
                    <!-- end:/navbar-main -->

                    <!-- start:navbar-content -->
                    <section id="navbar-content">
                        @include('front.include.header-search')
                    </section>
                    <!-- end:/navbar-content -->

                    <!-- start:header-content -->
                    <section id="header-content" data-spy="affix" data-offset-top="146">
                        @include('front.include.header-navbar')
                    </section>
                    <!-- end:/header-content -->

                    @yield('slider')
                </header>
                <!-- end:/header -->

                <!-- start:main content -->
                <section id="content">
                    @yield('content', 'Default content')
                </section>
                <!-- end:/main content -->

                <!-- start:footer -->
                <footer class="footer">
                    @include('front.include.footer')
                </footer>
                <!-- end:/footer -->
            </content>
        </div>

        <!-- start:javascript -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('build.js') }}"></script>

        @yield('scripts')        
        <!-- end:/javascript -->
    </body>
</html>