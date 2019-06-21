<div class="list-group list-group-transparent mb-0">
    <a href="{{ route('settings.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ active('settings.index') }}">
        <i class="fe fe-settings mr-2"></i> @lang('Settings')
    </a>
    <a href="{{ route('settings.users.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ active('settings.users.*') }}">
        <i class="fe fe-users mr-2"></i> @lang('Users')
    </a>
    <a href="{{ route('settings.packages.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ active('settings.packages.*') }}">
        <i class="fe fe-package mr-2"></i> @lang('Packages')
    </a>
    <a href="{{ route('settings.proxy.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ active('settings.proxy.*') }}">
        <i class="fe fe-shield mr-2"></i> @lang('Proxies')
    </a>
</div>