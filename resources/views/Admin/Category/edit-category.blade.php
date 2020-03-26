@extends('layouts.app-admin')
@section('title','Edit Category')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Category</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
<form role="form" action ="/category/{{$category->id}}/update" method="post">
    @csrf
    @method('PUT')
      <div class="card-body">
       <div class="row">
           <div class="col-md-12">
            @include('layouts.includes.success')
            <div class="form-group">
                <label for="category_name">Category Name</label>
            <input type="text" class="form-control @error('category_name') is-invalid @enderror" 
            id="category_name" placeholder="Category name" name="category_name" value="{{$category->category_name}}">
                @error('category_name')
                    <span class="validation-error">{{ $message }}</span>
                @enderror
            </div>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      </div>
      <!-- /.card-body -->
    </form>
  </div>
@endsection