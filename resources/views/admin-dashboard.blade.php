@extends('layouts.app')

@section('content')
<div class="row">
     <div class="col-sm-12">
         Admin Dashboard!
        </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-blue mr-3">
                    <i class="fe fe-users"></i>
                </span>
                <div>
                    <h4 class="m-0"><a href="{{ route('list.index', 'users') }}">{{ $users_count }} <small>@lang('Users Count')</small></a></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-green mr-3">
                  <i class="fe fe-instagram"></i>
                </span>
                <div>
                    <h4 class="m-0"><a href="{{ route('account.index') }}">{{ $accounts_count }} <small>@lang('Instagram Accounts')</small></a></h4>
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
                    <h4 class="m-0"><a href="{{ route('list.index', 'messages') }}">{{ 0 }} <small>@lang('Messages Count')</small></a></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp stamp-md bg-yellow mr-3">
                  <i class="fe fe-play"></i>
                </span>
                <div>
                    <h4 class="m-0"><a href="{{ route('list.index', 'users') }}">{{ 0 }} <small>@lang('Autopilots Count')</small></a></h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection