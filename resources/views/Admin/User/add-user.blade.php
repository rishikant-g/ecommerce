@extends('layouts.app-admin')
@section('title','Add User')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add User</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
<form role="form" action ="{{route("storeuser") }}" method="post">
    @csrf
      <div class="card-body">
       <div class="row">
           <div class="col-md-12">
            @include('layouts.includes.success')
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="email" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputEmail1" placeholder="First Name" name="first_name">
                @error('first_name')
                    <span class="validation-error">{{ $message }}</span>
                @enderror
            </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="email" class="form-control @error('last_name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" name="last_name">
                    @error('last_name')
                         <span class="validation-error">{{ $message }}</span>
                    @enderror
                </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12">
                <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" name="email">
                @error('email')
                         <span class="validation-error">{{ $message }}</span>
                @enderror
                </div>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password">
                @error('password')
                         <span class="validation-error">{{ $message }}</span>
                 @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password_confirmation">
                    @error('password_confirmation')
                         <span class="validation-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-md-2">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio1" name="status" value="1">
                        <label for="customRadio1" class="custom-control-label">Active</label>
                    </div>
                </div>
             </div> 
             <div class="col-md-2">
                <div class="form-group">
                    <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio2" name="status" value="0">
                    <label for="customRadio2" class="custom-control-label">Inactive</label>
                    </div>
                </div>
             </div>
        </div>
        @error('status')
            <span class="validation-error">{{ $message }}</span>
        @enderror
        <div class="row">
            <div class="col-sm-6">
              <!-- select -->
              <div class="form-group">
                <label>Custom Select</label>
                <select class="custom-select" name="role">
                  <option>Select Role</option>
                    @foreach($roles as $role)
                      <option value={{$role->id}}>{{$role->role_name}}</option>
                    @endforeach
                </select>
             @error('role')
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