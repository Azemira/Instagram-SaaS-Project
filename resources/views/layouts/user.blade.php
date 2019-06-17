<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <link rel="icon" href="assets/img/favicon.png" type="image/png"> --}}
  <title>AutoDimes</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/user/reset.css">
  <link rel="stylesheet" href="css/libs/fontawesome/font-awesome.min.css">
  <link rel="stylesheet" href="css/libs/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="css/user/main.css">
</head>
<body>
        <header class="header_area blue_bg">
            <div class="main_menu">
                @include('navigation.user.top')
            </div>
        </header>
       
            @yield('content')
        
        <footer class="footer_area">
            <div class="container-fluid">
                <div class="row footer_inner">
                    <div class="col-12 col-md-3">
                        <aside class="f_widget widget-1">
                            <div class="f_title">
                                <h3>Lorem ipsum</h3>
                            </div>
                        </aside>
                    </div>
                    <div class="col-12 col-md-6">
                        <aside class="f_widget widget-2">
                            <div class="f_title">
                                <h3>Lorem ipsum</h3>
                            </div>
                            <p>Nulla varius dui aliquet, pulvinar orci et, faucibus purus. Mauris sodales massa lacus, vitae dignissim
                                felis laoreet eu.
                            </p>
                            <p>Copyright ©
                                    <script>
                                    document.write(new Date().getFullYear());
                                    </script>
                                    All rights reserved | Lorem ipsum</p>
                        </aside>
                    </div>
                    <div class="col-12 col-md-3">
                        <aside class="f_widget social_widget">
                            <div class="f_title">
                                <h3>Lorem ipsum</h3>
                            </div>
                            <p>Etiam ac magna ac lorem ornare rhoncus eu aliquet est.</p>
                            <ul class="list">
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
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </footer>
        <script src="css/libs/jQuery/jquery-3.4.1.min.js"></script>
        <script src="css/libs/bootstrap/bootstrap.min.js"></script>
        <script src="js/user/main.js"></script>
    </body>
    
    </html>

