@extends('layouts.app')

@section('content')

        <section class="login_area">
            <div class="container form-wrap">
                <div class="row form-content">
                    <div class="login-form">
                        <div class="col-12 form-wrapper show" id="login-form-wrapper">
                          
                            <form method="POST" action="{{ route('register') }}" class="row login_form" id="loginForm">
                                @csrf
                                <h1 class="col-12">Register</h1>
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <i class="fas fa-user"></i>
                                        <input id="username" type="text" placeholder="Username" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <i class="fas fa-envelope"></i>
                                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <i class="fas fa-key"></i>
                                       
                                        <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <i class="fas fa-key"></i>
                                        <input id="password-confirm" placeholder="Retype password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" value="submit" class="btn submit_btn">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection