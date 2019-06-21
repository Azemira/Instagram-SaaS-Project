@extends('layouts.app')

@section('title', __('Profile'))

@section('content')
<form role="form" method="post" action="{{ route('profile.update') }}" autocomplete="off">
    @csrf
    @method('PUT')

    <div class="row row-deck">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Profile')</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">@lang('Name')</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="@lang('Full name')">
                    </div>
                    <div class="form-group">
                        <label class="form-label">E-mail</label>
                        <input type="email" value="{{ $user->email }}" class="form-control disabled" placeholder="E-mail" disabled>
                        <small class="help-block">@lang('E-mail can\'t be changed')</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Change password')</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">@lang('Password')</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="@lang('Password')">
                    </div>
                    <div class="form-group">
                        <label class="form-label">@lang('Confirm password')</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation" placeholder="@lang('Confirm password')">
                    </div>
                    <div class="alert alert-info">
                        <i class="fe fe-info mr-2"></i> @lang('Type new password if you would like to change current password.')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-primary ml-auto">@lang('Update profile')</button>
    </div>
</form>
@stop