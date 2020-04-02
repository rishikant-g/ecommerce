@extends('layouts.app-admin')
@section('title','Add Product')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Product</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
<form role="form" action ="/update/{{$product->id}}/product" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
      <div class="card-body">
       <div class="row">
           <div class="col-md-12">
            @include('layouts.includes.success')
            <div class="form-group">
                <label for="product_title">Product Title</label>
                <input type="text" class="form-control @error('product_title') is-invalid @enderror" id="product_title"
                 placeholder="Product Title" name="product_title"  value="{{ $product->product_title}}">
                @error('product_title')
                    <span class="validation-error">{{ $message }}</span>
                @enderror
            </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12">
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <input type="text" class="form-control @error('product_description') is-invalid @enderror" id="product_description"
                     placeholder="Product Description" name="product_description" value="{{ $product->product_description }}">
                    @error('product_description')
                         <span class="validation-error">{{ $message }}</span>
                    @enderror
                </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12">
                <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price" 
                placeholder="Enter email" name="product_price"  value="{{ $product->product_price }}">
                @error('product_price')
                         <span class="validation-error">{{ $message }}</span>
                @enderror
                </div>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                 <div class="form-group">
                 <label for="product_quantity">Product Quantity</label>
                 <input type="text" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity" 
                 placeholder="Enter email" name="product_quantity"  value="{{$product->product_quantity}}">
                 @error('product_quantity')
                          <span class="validation-error">{{ $message }}</span>
                 @enderror
                 </div>
            </div>
         </div>

          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Categories</label>
                    <select class="select2bs4" multiple="multiple" data-placeholder="Select Category"
                            style="width: 100%;" name="categories[]">
                            <option>Select Category</option>
                            @foreach($categories as $category)
                                @foreach($product_category as $pc)
                                    @if($category->id == $pc->id)
                                    <option value="{{$category->id}}" selected>{{$category->category_name}}</option>
                                    @endif
                                @endforeach
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                    </select>
                  </div>
                  @error('categories')
                  <span class="validation-error">{{ $message }}</span>
                  @enderror
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_image">File input</label>
                    <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="product_images" name="product_images[]" multiple>
                        <label class="custom-file-label" for="product_images">Choose file</label>
                    </div>
                    </div>
                </div>
                
                  @error('product_image')
                            <span class="validation-error">{{ $message }}</span>
                  @enderror
                
            </div>
        </div>



            <div class="row">
                <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-md-10">
                    @foreach($images as $image)
                        <img src="{{url('storage/products/'.$image->product_image)}}" style="width:50px;height:60px;margin:10px;"/>
                    @endforeach
                </div>
            </div>
      </div>
      <!-- /.card-body -->
    </form>
  </div>
@endsection