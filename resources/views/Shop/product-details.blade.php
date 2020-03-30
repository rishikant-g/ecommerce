@extends('layouts.app-shop')
@section('content')
@section('title','Demo Ecommerce Site')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach($categories as $category)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title"><a href="#">{{$category->category_name}}</a></h4>
                            </div>
                        </div>
                        @endforeach
                    </div><!--/category-products-->
                    
                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                             <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                             <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->
                    
                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{url('storage/front/images/home/shipping.jpg')}}" alt="" />
                    </div><!--/shipping-->
                
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                @foreach($product as $p)
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            @if(!empty($p->image[0]))
                            <img src="{{url('storage/products/'.$p->image[0]->product_image)}}" alt="" />
                            @endif
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
								
                            <!-- Wrapper for slides -->
                              <div class="carousel-inner">
                                  @foreach($p->image as  $img)
                                    <div class="item @if($loop->first) active @endif">
                                        <a href=""><img src="{{url('storage/products/'.$img->product_image)}}" alt=""></a>
                                    </div>    
                                  @endforeach                              
                              </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                              <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                              <i class="fa fa-angle-right"></i>
                            </a>
                      </div>
                    </div>
                   
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2>{{$p->product_title}}</h2>
                                <p>Web ID: 1089772</p>
                                <img src="images/product-details/rating.png" alt="" />
                                <span>
                                <span>{{$p->product_price}}</span>
                                    <label>Quantity:</label>
                                    <input type="text" value="3" />
                                    <button type="button" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </span>
                                <p><b>Availability:</b> In Stock</p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Brand:</b> E-SHOPPER</p>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                        </div>
                    @endforeach
                </div><!--/product-details-->                
                
            </div>
        </div>
    </div>
</section>
@endsection