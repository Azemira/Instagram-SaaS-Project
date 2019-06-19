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
        
            @include('footer.user.footer')
        <script src="css/libs/jQuery/jquery-3.4.1.min.js"></script>
        <script src="css/libs/bootstrap/bootstrap.min.js"></script>
        <script src="css/libs/tilt/tilt.jquery.js"></script>
        <script src="js/user/main.js"></script>
    </body>
    
    </html>

