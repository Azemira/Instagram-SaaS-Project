@extends('layouts.app')

@section('title', __('Settings'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Settings')</h1>
</div>

<div class="row">
    <div class="col-md-9">

        <form role="form" method="post" action="{{ route('settings.update') }}" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-sliders mr-2"></i> @lang('General settings')</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Site URL')</label>
                                <input type="text" name="settings[APP_URL]" value="{{ config('app.url') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Site name')</label>
                                <input type="text" name="settings[APP_NAME]" value="{{ config('app.name') }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('Description')</label>
                        <textarea name="settings[SITE_DESCRIPTION]" rows="2" class="form-control">{{ config('pilot.SITE_DESCRIPTION') }}</textarea>
                        <small class="help-block">@lang('Recommended length of the description is 150-160 characters')</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('Keywords')</label>
                        <textarea name="settings[SITE_KEYWORDS]" rows="3" class="form-control">{{ config('pilot.SITE_KEYWORDS') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Landing page skin')</label>
                                <select name="settings[SITE_SKIN]" class="form-control">
                                    @foreach($skins as $skin)
                                        <option value="{{ $skin }}" {{ $skin == config('pilot.SITE_SKIN') ? 'selected' : '' }}>{{ $skin }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Trial days')</label>
                                <input type="text" name="settings[TRIAL_DAYS]" value="{{ config('pilot.TRIAL_DAYS') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Schedule type')</label>
                                <select name="settings[SCHEDULE_TYPE]" class="form-control">
                                    <option value="cron" {{ 'cron' == config('pilot.SCHEDULE_TYPE') ? 'selected' : '' }}>@lang('Cron job')</option>
                                    <option value="supervisor" {{ 'supervisor' == config('pilot.SCHEDULE_TYPE') ? 'selected' : '' }}>@lang('Supervisor')</option>
                                </select>
                                <small class="help-block">@lang('If your hosting does not allow you to install Supervisor, tasks can be performed by regular cron job.')</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="settings[SYSTEM_PROXY]" value="1" class="custom-switch-input" {{ config('pilot.SYSTEM_PROXY') ? 'checked' : '' }}>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">@lang('Enable system proxy')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <small class="help-block">@lang('If you enable this option, system will try use most appropriate proxy from your proxy list while new account is being added.')</small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="settings[CUSTOM_PROXY]" value="1" class="custom-switch-input" {{ config('pilot.CUSTOM_PROXY') ? 'checked' : '' }}>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">@lang('Users can add their own proxy address')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <small class="help-block">@lang('Allow users to use their own proxy address.')</small>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-volume-2 mr-2"></i> @lang('Localization')</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Default language')</label>
                                <select name="settings[APP_LOCALE]" class="form-control">
                                    @foreach($languages as $code => $language)
                                        <option value="{{ $code }}" {{ $code == config('app.locale') ? 'selected' : '' }}>{{ $language['native'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Currency symbol')</label>
                                <input type="text" name="settings[CURRENCY_SYMBOL]" value="{{ config('pilot.CURRENCY_SYMBOL') }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Timezone')</label>
                                <select name="settings[APP_TIMEZONE]" class="form-control">
                                    @foreach($time_zones as $zone)
                                        <option value="{{ $zone }}" {{ $zone == config('app.timezone') ? 'selected' : '' }}>{{ $zone }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Currency')</label>
                                <select name="settings[CURRENCY_CODE]" class="form-control">
                                    @foreach($currencies as $code => $title)
                                        <option value="{{ $code }}" {{ $code == config('pilot.CURRENCY_CODE') ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Tax percentage')</label>
                                <input type="number" min="0" max="100" step="0.01" name="settings[TAX_PERCENTAGE]" value="{{ config('pilot.TAX_PERCENTAGE') }}" class="form-control">
                                <small class="help-block">@lang('Numeric value between 0 and 100, with no more than 2 decimal places.')</small>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-mail mr-2"></i> @lang('E-mail Settings')</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Host')</label>
                                <input type="text" name="settings[MAIL_HOST]" value="{{ config('mail.host') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Port')</label>
                                <input type="text" name="settings[MAIL_PORT]" value="{{ config('mail.port') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Username')</label>
                                <input type="text" name="settings[MAIL_USERNAME]" value="{{ config('mail.username') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Password')</label>
                                <input type="text" name="settings[MAIL_PASSWORD]" value="{{ config('mail.password') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('SMTP Encryption')</label>
                                <select name="settings[MAIL_ENCRYPTION]" class="form-control">
                                    <option value="" {{ null == config('mail.encryption') ? 'selected' : '' }}>@lang('No encryption')</option>
                                    <option value="tls" {{ 'tls' == config('mail.encryption') ? 'selected' : '' }}>@lang('TLS')</option>
                                    <option value="ssl" {{ 'ssl' == config('mail.encryption') ? 'selected' : '' }}>@lang('SSL')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('From address')</label>
                                <input type="text" name="settings[MAIL_FROM_ADDRESS]" value="{{ config('mail.from.address') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('From name')</label>
                                <input type="text" name="settings[MAIL_FROM_NAME]" value="{{ config('mail.from.name') }}" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fe fe-code mr-2"></i> @lang('Integrations')</h3>
                </div>
                <div class="card-body">

                    <h5>@lang('Google Analytics')</h5>

                    <div class="form-group">
                        <label class="form-label">@lang('Property ID')</label>
                        <input type="text" name="settings[GOOGLE_ANALYTICS]" value="{{ config('pilot.GOOGLE_ANALYTICS') }}" class="form-control" placeholder="UA-XXXXX-Y">
                        <small class="help-block">@lang('Leave this field empty if you don\'t want to enable Google Analytics')</small>
                    </div>

                    <hr>

                    <h5>@lang('Google reCaptcha')</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Site key')</label>
                                <input type="text" name="settings[RECAPTCHA_SITE_KEY]" value="{{ config('recaptcha.api_site_key') }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Secret key')</label>
                                <input type="text" name="settings[RECAPTCHA_SECRET_KEY]" value="{{ config('recaptcha.api_secret_key') }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>@lang('To protect your registration form, you can use Google reCaptcha service.')</p>
                            <ul>
                                <li>@lang('Get your free credentials from <a href=":link" target="_blank">:link</a>', ['link' => 'https://www.google.com/recaptcha/admin'])</li>
                                <li>@lang('Select "reCAPTCHA v2" as a site key type.')</li>
                                <li>@lang('Copy & paste the site and secret keys')</li>
                            </ul>
                        </div>
                    </div>

                    <hr>

                    <h5>@lang('Stripe')</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Publishable key')</label>
                                <input type="text" name="settings[STRIPE_KEY]" value="{{ config('services.stripe.key') }}" class="form-control" placeholder="pk_XXX">
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Secret key')</label>
                                <input type="text" name="settings[STRIPE_SECRET]" value="{{ config('services.stripe.secret') }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Webhook signing secret')</label>
                                <input type="text" name="settings[STRIPE_WEBHOOK_SECRET]" value="{{ config('services.stripe.webhook.secret') }}" class="form-control" placeholder="whsec_XXX">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>@lang('To get your recurring payments works, system have to receive hooks from the Stripe.')</p>
                            <ul>
                                <li>@lang('Go to webhook settings at Stripe <a href=":link" target="_blank">account dashboard</a>', ['link' => 'https://dashboard.stripe.com/account/webhooks'])</li>
                                <li>@lang('Click the "+ Add endpoint" button at "Developers" &rarr; "Endpoints" section.')</li>
                                <li>@lang('Include the following address to the "URL to be called" section: <a href=":link" target="_blank">:link</a>', ['link' => route('stripe.webhook')])</li>
                                <li>@lang('Select all events as a value of "Filter event"')</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> @lang('Save settings')
                    </button>
                </div>
            </div>

        </form>

    </div>
    <div class="col-md-3">
        @include('partials.settings-sidebar')
    </div>
</div>
@stop