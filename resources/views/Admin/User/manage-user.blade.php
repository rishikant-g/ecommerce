@extends('layouts.app-admin')

@section('content')
    <!-- /.card-header -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title float-left">Users</h3>
      <a href="{{route('adduser')}}"  class="btn btn-primary float-right addUser">Add</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered user-table">
          <thead>
          <tr>
              <th>No</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th width="100px">Role</th>
              <th width="100px">Action</th>
          </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card-body -->
  </div>
@endsection

