@extends('layouts.app')
@section('content')
<section class="error_area h-100">
    <div class="container error-page-wrap">
        <div id="notfound">
            <div class="notfound">
                <div class="notfound-claud">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <div class="notfound-404" data-tilt>
                    <h1>404</h1>
                    <h2>Oops! Nothing was found</h2>
                </div>
                <p>
                    "The page you are looking for might have been removed had its name changed or is temporarily unavailable."
                    <a href="/">Return to homepage</a>
                </p>
                <div class="notfound-social">
                    <a href="#">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
</section>
@endsection