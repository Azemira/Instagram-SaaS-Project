@extends('layouts.app')

@section('content')
@if(!Auth::user()->authorizeRoles(['admin']) )
 You are not authorized to access this page.
@else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Admin!
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection