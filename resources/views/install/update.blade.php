@extends('layouts.install')

@section('content')

    <form method="post" action="{{ route('update.finish') }}">
        @csrf

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update</h3>
            </div>
            <div class="card-body">

                <p>Update your application to the latest version.</p>

            </div>
            <div class="card-footer">
                <button class="btn btn-block btn-primary">Update application</button>
            </div>
        </div>

    </form>

@endsection