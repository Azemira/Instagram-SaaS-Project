@extends('layouts.app')

@section('title', __('Messages lists'))

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @lang('Messages lists')
        </h1>
        <div class="page-options">
            <form method="get" action="{{ route('list.index', $type) }}" autocomplete="off" class="d-flex">
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
            <h3 class="card-title">@lang('Messages lists')</h3>
            <div class="card-options">
                <a href="{{ route('list.create', $type) }}" class="btn btn-success">
                    <i class="fe fe-plus"></i> @lang('Create new list')
                </a>
            </div>
        </div>

        @if($data->count() > 0)
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap" id="accounts">
                <thead>
                    <tr>
                        <th>@lang('List name')</th>
                        <th>@lang('Messages count')</th>
                        <th class="text-right">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>
                            <a href="{{ route('list.edit', [$type, $item]) }}">{{ $item->name }}</a>
                            <div class="small text-muted">
                                @lang('Added: :time', ['time' => $item->created_at->format('M j, Y')])
                            </div>
                        </td>
                        <td>
                            <span class="tag">{{ $item->items_count }}</span>
                        </td>
                        <td class="text-right">
                            <form method="post" action="{{ route('list.destroy', [$type, $item]) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
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
            <i class="fe fe-alert-triangle mr-2"></i> @lang('No messages found')
        </div>
    @endif

@stop