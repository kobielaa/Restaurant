<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AllRestaurants</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Bootstrap Datepicker -->
    <link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <!-- Bootstrap Select -->
    <link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
    <!-- Select 2 -->
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
    <!-- Lightbox Image Overlay -->
    <link href="{{asset('css/lightbox.min.css')}}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
    <aside class="user-menu">
        @include('partials.user-menu')
    </aside>
    <header>
        @include('partials.header')
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <aside class="sidebar">
                    @include('partials.sidebar')
                </aside>
            </div>
            <div class="col-lg-10">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <footer>
        @include('partials.footer')
    </footer>
    <!-- Scripts -->
    <!-- Reference block for JS -->
    <div class="ref" id="ref">
        <div class="color-primary"></div>
        <div class="chart">
            <div class="color-primary"></div>
            <div class="color-secondary"></div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
