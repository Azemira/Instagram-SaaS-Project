<div class="row align-items-center">
    <div class="col-lg-3 ml-auto my-3 text-right">
        @can('admin')
        <a href="{{ route('settings.index') }}" class="btn btn-outline-primary btn-sm {{ active('settings.*') }}">
            <i class="fe fe-settings"></i> @lang('Settings')
        </a>
        @endcan
    </div>
    <div class="col-lg order-lg-first">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fe fe-home"></i> @lang('Dashboard')
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('account.index') }}" class="nav-link {{ active('account.*') }}">
                    <i class="fe fe-instagram"></i> @lang('Accounts')
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link {{ active('list.*') }}" data-toggle="dropdown">
                    <i class="fe fe-list"></i> @lang('Lists')
                </a>
                <div class="dropdown-menu dropdown-menu-arrow">
                    <a href="{{ route('list.index', 'messages') }}" class="dropdown-item {{ active( route('list.index', 'messages') ) }}">
                        <i class="fe fe-message-square"></i> @lang('Messages')
                    </a>
                    <a href="{{ route('list.index', 'users') }}" class="dropdown-item {{ active( route('list.index', 'users') ) }}">
                        <i class="fe fe-users"></i> @lang('Users')
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('dm.message') }}" class="nav-link {{ active('dm.message') }}">
                    <i class="fe fe-send"></i> @lang('Send message')
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('autopilot.index') }}" class="nav-link {{ active('autopilot.*') }}">
                    <i class="fe fe-play"></i> @lang('Autopilot')
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('direct.index') }}" class="nav-link {{ active('direct.*') }}">
                    <i class="fe fe-message-circle"></i> @lang('Direct Messenger')
                </a>
            </li>
        </ul>
    </div>
</div>

