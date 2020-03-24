@extends('layouts.app-admin')
@section('title','Add Banner')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Banner</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
<form role="form" action ="{{route("store.banner") }}" method="post" enctype="multipart/form-data">
    @csrf
      <div class="card-body">
       <div class="row">
           <div class="col-md-12">
            @include('layouts.includes.success')
            <div class="form-group">
                <label for="category_name">Banner Name</label>
                <input type="text" class="form-control @error('banner_name') is-invalid @enderror" id="banner_name" placeholder="Category name" name="banner_name">
                @error('banner_name')
                    <span class="validation-error">{{ $message }}</span>
                @enderror
            </div>
           </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="banner_image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    @error('banner_image')
                      <span class="validation-error">{{ $message }}</span>
                      @enderror
                    </div>
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