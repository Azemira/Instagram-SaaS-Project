@extends('layouts.app')

@section('content')

    @includeWhen($accounts->count() == 0, 'partials.no-accounts')

    <div class="card">
        <img src="{{ asset('assets/img/card-header.png') }}" class="card-img-top">
        @if (session('status'))
        <div class="card-body">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                        <i class="fe fe-play"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="{{ route('autopilot.index') }}">{{ $autopilots_count }} <small>@lang('Autopilot')</small></a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fe fe-shopping-cart"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="{{ route('account.index') }}">{{ $accounts_count }} <small>@lang('Accounts')</small></a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                        <i class="fe fe-message-square"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="{{ route('list.index', 'messages') }}">{{ $messages_list_count }} <small>@lang('Messages lists')</small></a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                      <i class="fe fe-users"></i>
                    </span>
                    <div>
                        <h4 class="m-0"><a href="{{ route('list.index', 'users') }}">{{ $users_list_count }} <small>@lang('Users lists')</small></a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('log.clear') }}" onsubmit="return confirm('@lang('Are you sure?')');">
        @csrf
        <div class="row">
           <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right">
                            <button name="status" value="{{ config('pilot.JOB_STATUS_ON_QUEUE') }}" class="btn btn-sm btn-secondary">
                                <i class="fe fe-x"></i> @lang('Clear queue')
                            </button>
                        </div>
                        <div class="h1 m-0">{{ $messages['on_queue']['total'] }}</div>
                        <div class="text-muted mb-4">@lang('Messages on queue')</div>
                        <div class="progress progress-sm">
                           <div class="progress-bar bg-green" style="width: {{ $messages['on_queue']['percentage'] }}%"></div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right">
                            <button name="status" value="{{ config('pilot.JOB_STATUS_SUCCESS') }}" class="btn btn-sm btn-secondary">
                                <i class="fe fe-x"></i> @lang('Clear log')
                            </button>
                        </div>
                        <div class="h1 m-0">{{ $messages['sent']['total'] }}</div>
                        <div class="text-muted mb-4">@lang('Sent messages')</div>
                        <div class="progress progress-sm">
                           <div class="progress-bar bg-blue" style="width: {{ $messages['sent']['percentage'] }}%"></div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-sm-4">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right">
                            <button name="status" value="{{ config('pilot.JOB_STATUS_FAILED') }}" class="btn btn-sm btn-secondary">
                                <i class="fe fe-x"></i> @lang('Clear log')
                            </button>
                        </div>
                        <div class="h1 m-0">{{ $messages['failed']['total'] }}</div>
                        <div class="text-muted mb-4">@lang('Failed to sent messages')</div>
                        <div class="progress progress-sm">
                           <div class="progress-bar bg-red" style="width: {{ $messages['failed']['percentage'] }}%"></div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Notifications')</h3>
                    <div class="card-options">
                        <a href="{{ route('notifications') }}" class="btn btn-sm btn-primary">@lang('View all')</a>
                    </div>
                </div>

                @if($notifications->count() > 0)
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="accounts">
                        <tbody>
                            @foreach($notifications as $notification)
                            <tr>
                                <td>
                                    {!! __('pilot.notification_' . $notification->data['action'], $notification->data) !!}
                                    <div class="small text-muted">{{ $notification->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="text-right">
                                    @if($notification->read_at == null)
                                    <span class="badge badge-success">@lang('NEW')</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Accounts')</h3>
                    <div class="card-options">
                        <a href="{{ route('account.index') }}" class="btn btn-sm btn-primary">@lang('View all')</a>
                    </div>
                </div>

                @if($accounts->count() > 0)
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="accounts">
                        <tbody>
                            @foreach($accounts as $account)
                            <tr data-username="{{ $account->username }}">
                                <td class="text-center" width="68">
                                    <div class="avatar d-block"></div>
                                </td>
                                <td>
                                    <a href="{{ route('account.edit', $account) }}">{{ $account->username }}</a>
                                    <div class="small text-muted">
                                        @lang('Added: :time', ['time' => $account->created_at->format('M j, Y')])
                                    </div>
                                </td>
                                <td align="right">
                                    <div class="tag" title="@lang('Last sync:') {{ optional($account->followers_sync_at)->diffForHumans() ?? __('Not synchronized') }}">
                                        <span class="followers">{{ $account->followers_count }}</span> <span class="tag-addon tag-green"><i class="fe fe-users"></i></span>
                                    </div>
                                    <div class="tag ml-1" title="@lang('Last sync:') {{ optional($account->following_sync_at)->diffForHumans() ?? __('Not synchronized') }}">
                                        <span class="following">{{ $account->following_count }}</span> <span class="tag-addon tag-blue"><i class="fe fe-user-plus"></i></span>
                                    </div>
                                    <div class="tag ml-1">
                                        <span class="posts">{{ $account->posts_count }}</span> <span class="tag-addon tag-red"><i class="fe fe-image"></i></span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection