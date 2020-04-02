@extends('layouts.app-shop')
@section('content')
@section('title','Cart Details')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
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
                </tbody>
            </table>
            <a class="btn btn-default check_out pull-right" href="/checkout">Check Out</a>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection