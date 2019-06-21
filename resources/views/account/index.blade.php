@extends('layouts.app')

@section('title', __('Accounts'))

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @lang('Accounts')
        </h1>
        <div class="page-options">
            <form method="get" action="{{ route('account.index') }}" autocomplete="off" class="d-flex">
                <select name="sort" class="form-control w-auto">
                    <option value="desc" {{ (Request::get('sort') == 'desc' ? 'selected' : '') }}>@lang('Newest first')</option>
                    <option value="asc" {{ (Request::get('sort') == 'asc' ? 'selected' : '') }}>@lang('Oldest first')</option>
                </select>
                <div class="input-icon ml-2">
                    <span class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </span>

                    <div class="input-group">
                        <div class="input-icon ml-2">
                            <span class="input-icon-addon">
                                <i class="fe fe-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control" placeholder="@lang('Search')">
                        </div>

                        <span class="input-group-btn ml-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="fe fe-filter"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@lang('Accounts')</h3>
            <div class="card-options">
                <a href="{{ route('account.create') }}" class="btn btn-success">
                    <i class="fe fe-plus"></i> @lang('Add account')
                </a>
            </div>
        </div>

        @if($data->count() > 0)
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap" id="accounts">
                <thead>
                    <tr>
                        <th class="w-1"></th>
                        <th>@lang('Account')</th>
                        <th>@lang('Statistic')</th>
                        <th>@lang('Messages')</th>
                        <th class="text-right">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $account)
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
                        <td>
                            <div class="tag">
                                <span class="followers" title="@lang('Last sync:') {{ optional($account->followers_sync_at)->diffForHumans() ?? __('Not synchronized') }}">{{ $account->followers_count }}</span>
                                <span class="tag-addon tag-green">@lang('Followers')</span>
                                <a href="{{ route('account.export', [$account, 'followers']) }}" class="tag-addon tag-green" title="@lang('Export list')"><i class="fe fe-download"></i></a>
                            </div>
                            <div class="tag ml-1">
                                <span class="following" title="@lang('Last sync:') {{ optional($account->following_sync_at)->diffForHumans() ?? __('Not synchronized') }}">{{ $account->following_count }}</span>
                                <span class="tag-addon tag-blue">@lang('Following')</span>
                                <a href="{{ route('account.export', [$account, 'following']) }}" class="tag-addon tag-blue" title="@lang('Export list')"><i class="fe fe-download"></i></a>
                            </div>
                            <div class="tag ml-1">
                                <span class="posts">{{ $account->posts_count }}</span> <span class="tag-addon tag-red">@lang('Posts')</span>
                            </div>
                        </td>
                        <td>
                            <div class="tag">
                                <span>{{ $account->messages_on_queue_count }}</span> <span class="tag-addon tag-blue">@lang('On queue')</span>
                            </div>
                            <div class="tag ml-1">
                                <span>{{ $account->messages_sent_count }}</span> <span class="tag-addon tag-green">@lang('Sent')</span>
                            </div>
                            <div class="tag ml-1">
                                <span>{{ $account->messages_failed_count }}</span> <span class="tag-addon tag-red">@lang('Failed')</span>
                            </div>
                        </td>
                        <td class="text-right">
                            <form method="post" action="{{ route('account.destroy', $account) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-secondary btn-clean">
                                    <i class="fe fe-trash"></i> @lang('Delete')
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{ $data->appends( Request::all() )->links() }}

    @if($data->count() == 0)
        <div class="alert alert-primary text-center">
            <i class="fe fe-alert-triangle mr-2"></i> @lang('No accounts found')
        </div>
    @endif

@stop