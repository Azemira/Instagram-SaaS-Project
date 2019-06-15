@extends('layouts.app')

@section('content')
@if(!Auth::user()->authorizeRoles(['admin']) )
 You are not authorized to access this page.
@else
<section>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Date Joined</th>
                  <th>Role</th>
                  <th>Verified</th>
                  
                </tr>
                @if($users->count() == 0)
                <tr>
                    <td colspan="6" class="text-center">
                        No Users
                    </td>
                </tr>
                @endif
                @foreach($users as $user)
                <tr>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->created_at }}</td>
                  @if($user->authorizeRoles(['user']))
                  <td>User</td>
                  @else
                  <td>Admin</td>
                  @endif
                  @if(!$user->hasVerifiedEmail())
                  <td><span class="label label-danger">Unverified</span></td>
                  @else
                  <td><span class="label label-success">Verified</span></td>
                  @endif
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
@endif

@endsection