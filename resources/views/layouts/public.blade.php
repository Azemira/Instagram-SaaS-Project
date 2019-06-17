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
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.html">Logo</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-end">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.html">Home</a>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Packages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Package 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Package 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Package 3</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Subscribe</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                            </li>
                            <li class="nav-item button-item">
                                <a href="#" class="std_btn">Login</a>
                            </li>
                            <li class="nav-item button-item">
                                <a href="#" class="std_btn">Sign up</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <section class="content">
        @yield('content')
    </section>
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