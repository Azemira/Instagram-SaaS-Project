<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-home"></i> <a href="{{ route('dashboard') }}">@lang('Dashboard')</a></li>
                    <li><i class="fe fe-instagram"></i> <a href="{{ route('account.index') }}">@lang('Accounts')</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-message-square"></i> <a href="{{ route('list.index', 'messages') }}">@lang('Messages lists')</a></li>
                    <li><i class="fe fe-users"></i> <a href="{{ route('list.index', 'users') }}">@lang('Users lists')</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-send"></i> <a href="{{ route('dm.message') }}">@lang('Send message')</a></li>
                    <li><i class="fe fe-play"></i> <a href="{{ route('autopilot.index') }}">@lang('Autopilot')</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-message-circle"></i> <a href="{{ route('direct.index') }}">@lang('Direct Messenger')</a></li>
                    <li><i class="fe fe-user"></i> <a href="{{ route('profile.index') }}">@lang('Profile')</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <ul class="list-unstyled mb-2">
                    <li><i class="fe fe-credit-card"></i> <a href="{{ route('billing.index') }}">@lang('Billing')</a></li>
                    @can('admin')
                    <li><i class="fe fe-settings"></i> <a href="{{ route('settings.index') }}">@lang('Settings')</a></li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>
</div>