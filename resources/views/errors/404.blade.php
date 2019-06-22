<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{ asset('skins/default/img/favicon.png') }}" type="image/png">
        <title>{{ __(config('app.name')) }} &mdash; {{ __(config('pilot.SITE_DESCRIPTION')) }}</title>
        <meta name="description" content="{{ config('pilot.SITE_DESCRIPTION') }}">
        <meta name="keywords" content="{{ config('pilot.SITE_KEYWORDS') }}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('skins/default/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('skins/default/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('skins/default/vendors/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('skins/default/vendors/animate-css/animate.css') }}">
        <!-- main css -->
        <link rel="stylesheet" href="{{ asset('skins/default/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('skins/default/css/responsive.css') }}">
    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70">

        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu" id="mainNav">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						
						<a class="navbar-brand logo_h" style="    text-transform: uppercase;color: #fff;" href="{{ url('/') }}">{{ __(config('app.name')) }}</a>

						{{-- <a class="navbar-brand logo_h" href="{{ url('/') }}"><img src="{{ asset('skins/default/img/logo.png') }}" alt=""></a> --}}
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="#home">@lang('Home')</a></li>
								<li class="nav-item"><a class="nav-link" href="#feature">@lang('Features')</a></li>
								<li class="nav-item"><a class="nav-link" href="#price">@lang('Pricing')</a></li>
								@auth
								    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><strong>{{ $user->name }}</strong></a></li>
                                @else
                                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">@lang('Login')</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">@lang('Register')</a></li>
                                @endauth
							</ul>
						</div>
					</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->

        <!--================Home Banner Area =================-->
        <section class="home_banner_area" id="home" style="height:870px">
            <div class="banner_inner">
				<div class="container">
					<div class="row banner_content">
						<div class="col-lg-8" >
							<h2>@lang('Oops! Nothing was found')</h2>
							<p> "The page you are looking for might have been removed had its name changed or is temporarily unavailable."
                                    <a href="/">Return to homepage</a></p>
							{{-- <a class="banner_btn" href="{{ route('billing.index') }}">@lang('Try now')</a> --}}
						{{-- </div>
						<div class="col-lg-4"> --}}
							{{-- <div class="banner_map_img"> --}}
								{{-- <img class="img-fluid" src="{{ asset('skins/default/img/dm-landing.png') }}" alt=""> --}}
							{{-- </div> --}}
						</div>
					</div>
				</div>
            </div>
        </section>

        <!--================ start footer Area  =================-->
        <footer class="footer-area p_30">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="footer-text">
                            Copyright &copy;{{ date('Y') }} &bull; {{ __(config('app.name')) }} &mdash; {{ __(config('pilot.SITE_DESCRIPTION')) }}
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- {{ $active_language['native'] }} --}}
                            </button>
                            <div class="dropdown-menu">
                                {{-- @foreach($languages as $code => $language)
                                    <a href="{{ route('localize', $code) }}" rel="alternate" hreflang="{{ $code }}" class="dropdown-item">{{ $language['native'] }}</a>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
		<!--================ End footer Area  =================-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('skins/default/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('skins/default/js/popper.js') }}"></script>
        <script src="{{ asset('skins/default/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('skins/default/js/stellar.js') }}"></script>
        <script src="{{ asset('skins/default/js/theme.js') }}"></script>
    </body>
</html>