<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('id','desc')->limit(3)->get();
        $categories = Category::orderBy('category_name','asc')->get();

        return view('Shop.home')->with('banners',$banners)->with('categories',$categories);
    }
}
