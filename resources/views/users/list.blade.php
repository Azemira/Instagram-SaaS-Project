@extends('layouts.app')

@section('title', __('Users'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Users')</h1>
    <div class="page-options">
        <a href="{{ route('settings.users.create') }}" class="btn btn-success">
            <i class="fe fe-plus"></i> @lang('Create new user')
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        @if($data->count() > 0)
            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="accounts">
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('E-mail')</th>
                                <th>@lang('Subscription')</th>
                                <th class="text-right">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('settings.users.edit', $item) }}">{{ $item->name }}</a>
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>
                                    @if($item->subscribed('main'))
                                        <span class="text-green"><i class="fe fe-check"></i> @lang('Active')</span>
                                    @else
                                        <span class="text-muted"><i class="fe fe-x"></i> @lang('Not active')</span>
                                    @endif

                                </td>
                                <td class="text-right">
                                    <form method="post" action="{{ route('settings.users.destroy', $item) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
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
            </div>
        @endif

        {{ $data->appends( Request::all() )->links() }}

        @if($data->count() == 0)
            <div class="alert alert-primary text-center">
                <i class="fe fe-alert-triangle mr-2"></i> @lang('No users found')
            </div>
        @endif

    </div>
</div>
@stop