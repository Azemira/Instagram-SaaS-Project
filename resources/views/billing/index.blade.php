@extends('layouts.app')

@section('title', __('Billing'))

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @lang('Billing')
        </h1>
    </div>

    @if($subscription_subscribed && !$subscription_on_grace_period)
        <div class="alert text-center alert-success">
            <i class="fe fe-check mr-2"></i> @lang('Your subscription is currently active!')
        </div>
    @endif

    @if(($subscription_on_generic_trial || $subscription_on_trial) && !$subscription_subscribed)
        <div class="alert text-center alert-warning">
            <i class="fe fe-alert-triangle mr-2"></i>@lang('Your are on a trial period.')
        </div>
    @endif

    @if($subscription_on_grace_period)
        <div class="alert text-center alert-warning">
            <i class="fe fe-alert-triangle mr-2"></i>@lang('Your subscription is canceled, but you still on a grace period.')
        </div>
    @endif

    @if($subscription_ended)
        <div class="alert text-center alert-warning">
            <i class="fe fe-alert-triangle mr-2"></i>@lang('Your subscription has been ended!')
        </div>
    @endif

    @if(!$subscription_on_trial && !$subscription_subscribed)
        <div class="alert text-center alert-warning">
            <i class="fe fe-alert-triangle mr-2"></i>@lang('Your trial is expired, please upgrade your subscription.')
        </div>
    @endif

    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
    var form_id = null;
    var handler = StripeCheckout.configure({
        key: '{{ config('services.stripe.key') }}',
        image: '{{ asset('assets/img/secure-payment.png') }}',
        locale: 'auto',
        token: function(token) {

            var purchaseForm = document.getElementById(form_id);

            var inputStripeToken = document.createElement('input');
            inputStripeToken.type = 'hidden';
            inputStripeToken.name = 'stripeToken';
            inputStripeToken.value = token.id;
            purchaseForm.appendChild(inputStripeToken);

            var inputStripeTokenType = document.createElement('input');
            inputStripeTokenType.type = 'hidden';
            inputStripeTokenType.name = 'stripeTokenType';
            inputStripeTokenType.value = token.type;
            purchaseForm.appendChild(inputStripeTokenType);

            var inputstripeEmail = document.createElement('input');
            inputstripeEmail.type = 'hidden';
            inputstripeEmail.name = 'stripeEmail';
            inputstripeEmail.value = token.email;
            purchaseForm.appendChild(inputstripeEmail);

            purchaseForm.submit();

        }
    });

    window.addEventListener('popstate', function() {
        handler.close();
    });
    </script>

    <div class="row">
        @foreach($packages as $package)
            <div class="col-sm-6 col-lg-{{ 12 / count($packages) }}">
                <form action="{{ route('billing.purchase', $package) }}" id="billing-form-{{ $package->id }}" method="POST">
                    @csrf

                    <div class="card">
                        @if ($loop->index == 1)
                            <div class="card-status bg-green"></div>
                        @endif
                        <div class="card-body text-center">
                            <div class="card-category">{{ $package->title }}</div>
                            <div class="display-3 my-4">{{ $currency_symbol }}{{ $package->wholeprice }}.<sup>{{ $package->fraction_price }}</sup></div>
                            <p><span class="tag tag-rounded tag-purple">{{ __(':num days FREE trial', ['num' => config('pilot.TRIAL_DAYS')]) }}</span></p>
                            <ul class="list-unstyled leading-loose">
                                <li><strong>{{ trans_choice('pilot.package_accounts', $package->accounts_count, ['num' => $package->accounts_count]) }}</strong></li>
                                <li><i class="fe fe-check text-success mr-2"></i> @lang('Web Based Direct Messenger')</li>
                                <li><i class="fe fe-check text-success mr-2"></i> @lang('Send Bulk Messages')</li>
                                <li><i class="fe fe-check text-success mr-2"></i> @lang('Custom users lists')</li>
                                <li><i class="fe fe-check text-success mr-2"></i> @lang('Scheduled Autopilot')</li>
                                <li><i class="fe fe-check text-success mr-2"></i> @lang('Pre-defined messages lists')</li>
                                <li><i class="fe fe-check text-success mr-2"></i> @lang('Detect Unfollowers')</li>
                                <li><i class="fe fe-check text-success mr-2"></i> @lang('Spintax Support')</li>
                            </ul>
                            <small class="text-muted">
                                @lang('Prices shown in:') {{ $currency_code }}<br>
                                @lang('pilot.interval_' . $package->interval)
                            </small>
                            <div class="text-center mt-6">
                                @if ($loop->index == 1)
                                    <button type="button" id="package-{{ $package->id }}" class="btn btn-green btn-block">
                                        <i class="fe fe-check mr-2"></i> @lang('Choose plan')
                                    </button>
                                @else
                                    <button type="button" id="package-{{ $package->id }}" class="btn btn-secondary btn-block">
                                        <i class="fe fe-check mr-2"></i> @lang('Choose plan')
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <script type="text/javascript">
                document.getElementById('package-{{ $package->id }}').addEventListener('click', function(e) {

                    form_id = 'billing-form-{{ $package->id }}';
                    handler.open({
                        amount: '{{ $package->price_in_cents }}',
                        currency: '{{ $currency_code }}',
                        email: '{{ request()->user()->email }}',
                        name: '{{ $package->title }}',
                        description: '@lang('pilot.interval_' . $package->interval)',
                    });

                    e.preventDefault();

                });
            </script>
        @endforeach
    </div>

    @if($subscription_subscribed && !$subscription_on_grace_period)
        <div class="text-right">
            <form action="{{ route('billing.cancel') }}" method="POST" onsubmit="return confirm('@lang('Confirm cancel subscription?')');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-secondary btn-clean">
                    <i class="fe fe-x-circle"></i> @lang('Cancel subscription') &ndash; {{ Auth::user()->package->title }}
                </button>
            </form>
        </div>
    @endif

@endsection