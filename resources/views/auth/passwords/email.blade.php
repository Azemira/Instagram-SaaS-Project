@extends('layouts.app')

@section('content')

<body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <a href="../../index2.html"><b>Instagram</b>Saas</a>
          </div>
          <!-- /.login-logo -->
          <div class="login-box-body">
        
            <form method="POST" action="{{ route('password.email') }}">
                    @csrf
    
              <div class="form-group has-feedback">
                   
                    <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>



              <div class="row">
                <!-- /.col -->
                <div class="col-xs-8">
                   <button type="submit" class="btn btn-primary btn-block btn-flat">   {{ __('Send Password Reset Link') }}</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
        
        
          </div>
          <!-- /.login-box-body -->
        </div>
     
   
        </body>
        @endsection

