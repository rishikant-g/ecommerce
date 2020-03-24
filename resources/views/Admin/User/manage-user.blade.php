@extends('layouts.app-admin')

@section('content')
    <!-- /.card-header -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title float-left">DataTable with default features</h3>
      <a href="{{route('adduser')}}"  class="btn btn-primary float-right addUser">Add</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered user-table">
          <thead>
          <tr>
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
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

  <div id="form-content" style="display:none;">
    <form class="form" role="form">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="test@mail.ru"></input>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox"> Check me out
        </label>
      </div>
    </form>
  </div>


@endsection

@section('javascript')
<script>
   $(function () {
        var table = $('.user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('manageuser') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'first_name', name: 'first_name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
  </script>
@endsection