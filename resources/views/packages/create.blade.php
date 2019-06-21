@extends('layouts.app')

@section('title', __('Create new package'))

@section('content')
<div class="page-header">
    <h1 class="page-title">@lang('Create new package')</h1>
</div>

<div class="row">
    <div class="col-md-9">

        <form role="form" method="post" action="{{ route('settings.packages.store') }}">
            @csrf
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label class="form-label">@lang('Title')</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="@lang('Title')">
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('Price')</label>
                        <input type="number" min="0" step="0.01" name="price" value="{{ old('price') }}" class="form-control" placeholder="@lang('Price')">
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('Payment interval')</label>
                        <select name="interval" class="form-control">
                            <option value="day" {{ old('interval') == 'day' ? 'selected' : '' }}>@lang('pilot.interval_day')</option>
                            <option value="week" {{ old('interval') == 'week' ? 'selected' : '' }}>@lang('pilot.interval_week')</option>
                            <option value="month" {{ old('interval') == 'month' ? 'selected' : '' }}>@lang('pilot.interval_month')</option>
                            <option value="year" {{ old('interval') == 'year' ? 'selected' : '' }}>@lang('pilot.interval_year')</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">@lang('Accounts count')</label>
                        <input type="number" min="1" name="accounts_count" value="{{ old('accounts_count') }}" class="form-control" placeholder="@lang('Accounts count')">
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('settings.packages.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <button class="btn btn-success ml-auto">@lang('Add package')</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <div class="col-md-3">
        @include('partials.settings-sidebar')
    </div>
</div>


@stop