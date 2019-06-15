@extends('layouts.app')

@section('content')
@if(!Auth::user()->authorizeRoles(['admin']) )
 You are not authorized to access this page.
@else
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Quick Example</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

      <div class="box-body">
            <div class="form-group">
                    <label for="name">Userame</label>
                    <input type="text" name="name" class="form-control">
         </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        {{-- <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" id="exampleInputFile">

          <p class="help-block">Example block-level help text here.</p>
        </div> --}}
        {{-- <div class="checkbox">
          <label>
            <input type="checkbox"> Check me out
          </label>
        </div> --}}
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
@endif

@endsection