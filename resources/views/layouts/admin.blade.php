<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> AllRestaurant Admin Panel </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">

  <title>AllRestaurant Admin Panel</title>

  <!-- Bootstrap -->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- Bootstrap Datepicker -->
  <link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
  <!-- Bootstrap Select -->
  <link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
  <!-- Lightbox Image Overlay -->
  <link href="{{asset('css/lightbox.min.css')}}" rel="stylesheet">
  <!-- Admin Panel -->
  <link href="{{asset('adm/css/vendor.css')}}" rel="stylesheet">
  <link href="{{asset('adm/css/app.css')}}" rel="stylesheet">
  <link href="{{asset('css/admin.css')}}" rel="stylesheet">
</head>
<body>
  <div class="main-wrapper">
    <div id="app" class="app admin-panel">
      <header class="header">
        @include('admin.partials.topbar')
      </header>
      <aside class="sidebar">
        @include('admin.partials.sidemenu')
        <footer class="sidebar-footer">
          <ul class="sidebar-menu metismenu" id="customize-menu">
            <li>
              <ul>
                <li class="customize">
                  <div class="customize-item">
                    <div class="row customize-header">
                      <div class="col-4"> </div>
                      <div class="col-4">
                        <label class="title">fixed</label>
                      </div>
                      <div class="col-4">
                        <label class="title">static</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <label class="title">Sidebar:</label>
                      </div>
                      <div class="col-4">
                        <label>
                          <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
                          <span></span>
                        </label>
                      </div>
                      <div class="col-4">
                        <label>
                          <input class="radio" type="radio" name="sidebarPosition" value="">
                          <span></span>
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <label class="title">Header:</label>
                      </div>
                      <div class="col-4">
                        <label>
                          <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                          <span></span>
                        </label>
                      </div>
                      <div class="col-4">
                        <label>
                          <input class="radio" type="radio" name="headerPosition" value="">
                          <span></span>
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <label class="title">Footer:</label>
                      </div>
                      <div class="col-4">
                        <label>
                          <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                          <span></span>
                        </label>
                      </div>
                      <div class="col-4">
                        <label>
                          <input class="radio" type="radio" name="footerPosition" value="">
                          <span></span>
                        </label>
                      </div>
                    </div>
                  </div>         
                </li>
              </ul>
              <a href="">
                <i class="fa fa-cog"></i> Customize </a>
            </li>
          </ul>
        </footer>
      </aside>
      <article class="content dashboard-page">
        @yield('content')
      </article>
      <footer class="footer">
        <div class="footer-block buttons">
            
        </div>
        <div class="footer-block author">
            <ul>
                <li> created by
                    <a href="https://digitaldudes.pro">DigitalDudes</a>
                </li>
            </ul>
        </div>
    </footer>
    </div>
  </div>

  <!-- Scripts -->
  <div class="ref" id="ref">
    <div class="color-primary"></div>
    <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
  </div>
  <script>
    
  </script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
