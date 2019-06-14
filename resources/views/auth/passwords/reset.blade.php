@extends('layouts.app')

@section('content')


<body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <a href="../../index2.html"><b>Instagram</b>Saas</a>
          </div>
          <!-- /.login-logo -->
          <div class="login-box-body">
           
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
    
              <div class="form-group has-feedback">
                        <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>


              <div class="form-group has-feedback">
                        <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group has-feedback">
                        <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                      </div>


              <div class="row">
               
                <!-- /.col -->
                <div class="col-xs-12">
                   <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Reset Password') }}</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
        
          </div>
          <!-- /.login-box-body -->
        </div>
     
   
        </body>
        @endsection