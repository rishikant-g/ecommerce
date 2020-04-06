@extends('layouts.app-shop')
@section('content')
@section('title','Cart Details')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="shopper-informations">
            <form method="post" action="{{route('checkout.process')}}" id="address-form">
                @csrf
                <div class="row">
                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Bill To</p>
                        </div>
                    </div>					
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="exampleInputPassword1"
                        placeholder="First Name" name="first_name" 
                        @if(!empty($detail)) value="{{$detail->first_name}}" @else value="{{old('first_name')}}" @endif
                        >
                            @error('first_name')
                                 <span class="validation-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="exampleInputPassword1"
                         placeholder="Last Name" name="last_name" 
                         @if(!empty($detail)) value="{{$detail->last_name}}" @else value="{{old('last_name')}}" @endif
                         >
                            @error('last_name')
                                 <span class="validation-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="exampleInputPassword1" 
                        placeholder="Address" name="address" 
                        @if(!empty($detail)) value="{{$detail->address}}" @else value="{{old('address')}}" @endif
                        >
                            @error('address')
                                 <span class="validation-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Zip /Postal Code</label>
                        <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="exampleInputPassword1" 
                        placeholder="Zip / Postal Code" name="zip_code" 
                        @if(!empty($detail)) value="{{$detail->zip_code}}" @else value="{{old('zip_code')}}" @endif
                        >
                            @error('zip_code')
                                 <span class="validation-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Mobile</label>
                        <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="exampleInputPassword1" 
                        placeholder="Mobile Number" name="mobile_number" 
                        @if(!empty($detail)) value="{{$detail->mobile_number}}" @else value="{{old('mobile_number')}}" @endif
                        >
                            @error('mobile_number')
                                 <span class="validation-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Landmark</label>
                        <textarea class="form-control @error('landmark') is-invalid @enderror" id="exampleInputPassword1" 
                        placeholder="Landmark" name="landmark">@if(!empty($detail)) {{$detail->landmark}} @else {{old('landmark')}} @endif
                        </textarea>
                            @error('landmark')
                                 <span class="validation-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
 
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $key =>  $cart)
                    <tr>
                        <td class="cart_product">
                  
                            @if(!empty($cart->images))
                             <img src="{{url('storage/products/'.$cart->images->product_image )}}" alt="" style="width:145px;height:125px;"/>
                            @else
                                <img src="{{url('storage/products/default.jpg')}}" alt="" style="width:245px;height:225px;"/>
                            @endif
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart->product_title}}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>&#8360  {{$cart->product_price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="javascript:void(0)" data-product-price="{{$cart->product_price}}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->quantity}}" autocomplete="off" size="2">
                                <input class="cart_product_id" type="hidden"  value="{{$cart->id}}">
                                <a class="cart_quantity_down" href="javascript:void(0)" data-product-price="{{$cart->product_price}}"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">&#8360 {{ $cart->product_price * $cart->quantity }}</p>
                        </td>
                        <td class="cart_delete" data-product-id="{{$cart->id}}">
                            <a class="cart_quantity_delete" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>$59</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$2</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>$61</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-default check_out pull-right" href="javascipt:void(0)" 
            onclick="event.preventDefault();
            document.getElementById('address-form').submit();"
            >Check Out</a>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection