<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\Product;
use App\Image;
class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('id','desc')->limit(3)->get();
        $categories = Category::orderBy('category_name','asc')->get();
        $products = Product::orderBy('id','desc')->limit(6)->get();
        $prd = [];
        $i=0;
        foreach($products as $product){
            $data = Image::where(['product_id' => $product->id])->limit(1)->get();
            $prd[$i]['product']=$product;
            $prd[$i]['product']['image']=$data;
            $i++;
        }
        $final_data =[];
       foreach($prd as $p){
          foreach($p as $k){
              $final_data[] = $k;
          }
       }
    //    foreach($final_data as $data){
    //        return $data->product_title;
    //        return $data->image[0]->product_image;
    //    }

        return view('Shop.home')->with('banners',$banners)->with('categories',$categories)
        ->with('products',$final_data);
    }
}
