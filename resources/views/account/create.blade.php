@extends('layouts.app')

@section('title', __('Add account'))

@section('content')

    @if($needUpgrade)
        <div class="alert alert-danger text-center">
            <strong><i class="fe fe-alert-triangle mr-2"></i> @lang('You reached your accounts limit on current package. Please <a href=":link">upgrade</a> to add more accounts.', ['link' => route('billing.index')])</strong>
        </div>
    @else
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="dimmer">
                        <div class="loader"></div>
                        <div class="dimmer-content">
                            <div class="card-header">
                                <h3 class="card-title">@lang('Add account')</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="form-label">@lang('Username')</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fe fe-instagram"></i>
                                            </span>
                                        </span>
                                        <input type="text" name="username" class="form-control" placeholder="@lang('Username')" autocomplete="off">
                                    </div>
                                    <small class="help-block">@lang('Instagram username')</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">@lang('Password')</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fe fe-eye-off"></i>
                                            </span>
                                        </span>
                                        <input type="password" name="password" class="form-control" placeholder="@lang('Password')" autocomplete="off">
                                    </div>
                                    <small class="help-block">@lang('Instagram password')</small>
                                </div>

                                @if(config('pilot.CUSTOM_PROXY'))
                                <div class="form-group">
                                    <label class="form-label">@lang('Proxy')</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fe fe-lock"></i>
                                            </span>
                                        </span>
                                        <input type="text" name="proxy" class="form-control" placeholder="@lang('https://login:password@host:port')" autocomplete="off">
                                    </div>
                                    <small class="help-block">@lang('Set your proxy (optional)')</small>
                                </div>
                                @endif

                            </div>
                            <div class="card-footer">
                                <div class="d-flex">
                                    <a href="{{ route('account.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                                    <button class="btn btn-success btn-account-submit ml-auto">@lang('Add account')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-status card-status-left bg-red"></div>
                    <div class="card-header">
                        <h3 class="card-title">@lang('Attention!')</h3>
                    </div>
                    <div class="card-body">
                        <ol>
                            <li>@lang('My account is at least 14 days old')</li>
                            <li>@lang('I have access to the email address and phone number associated with the account')</li>
                            <li>@lang('I don\'t use third-party tools for this account')</li>
                            <li>@lang('My account is linked to my Facebook account')</li>
                            <li>@lang('Make sure that the content of your account does not violate the rules of work in Instagram')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop