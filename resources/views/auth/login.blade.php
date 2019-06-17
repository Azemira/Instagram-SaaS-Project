@extends('layouts.app')

@section('content')
        <section class="login_area">
            <div class="container form-wrap">
                <div class="row form-content">
                    <div class="login-form">
                        <div class="col-12 form-wrapper show" id="login-form-wrapper">
                          
                            <form method="POST" action="{{ route('login') }}" class="row login_form" id="loginForm">
                                @csrf
                                <h1 class="col-12">Login</h1>
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <i class="fas fa-user"></i>
                                        <input id="username" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                    <button type="submit" value="submit" class="btn submit_btn">Login</button>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="btn-wrapper">
                                        <a href="javascript:void(0)" data-openformid="forgot-form-wrapper" class="btn-rotate-form forgot-password">Forgot password?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 form-wrapper" id="forgot-form-wrapper">
                            <form method="POST" action="{{ route('password.email') }}" class="row forgot_form" id="forgotPasswordForm">
                                @csrf
                                <h2 class="col-12">Forgot password?</h2>
                                <p class="col-12 text">Enter your username or email in the field below and click Send button. An email with instructions
                                    on how to reset your password will be sent to you.</p>
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <i class="fas fa-user"></i>
                                        <input id="username" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" value="submit" class="btn submit_btn">Send</button>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="btn-wrapper">
                                        <a href="javascript:void(0)" data-openformid="login-form-wrapper" class="btn-rotate-form forgot-password">Back to login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection