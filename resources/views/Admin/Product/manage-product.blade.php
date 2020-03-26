@extends('layouts.app-admin')
@section('title','Manage Products')
@section('content')
    <!-- /.card-header -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title float-left">Products</h3>
      <a href="{{route('create.product')}}"  class="btn btn-primary float-right addUser">Add</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered product-table">
          <thead>
          <tr>
              <th>No</th>
              <th>Title</th>
              <th>Description</th>
              <th>Price</th>
              <th>Category</th>
              <th>Image</th>
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

