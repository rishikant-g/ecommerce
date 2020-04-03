<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Address;
use Illuminate\Support\Facades\Session;
use Auth;
class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    
        if(Cart::where(['session_id' => Session('sessionId')])->count() == 0 ){
            Session::flash('message', 'Kindly add some product to proceed'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back();
        }

        $products = Cart::groupBy('product_id')->where(['session_id' => Session('sessionId')])->selectRaw('product_id,sum(quantity) as sum')->get();

        $data = [];
        foreach($products as $p){
            $product = Product::find($p->product_id);
            $images = Product::find($p->product_id)->images->first();

            $data[$product->id]=$product;
            $data[$product->id]['quantity']=$p->sum;
            $data[$product->id]['images']=$images;
        }
        return view('Customer.checkout')->with('carts',$data);
    }

    public function processCheckout(\App\Http\Requests\StoreCustomerAddress $request)
    {
        $request->validated();
        $request['user_id'] = Auth::user()->id;
        Address::create($request->all());
    }
}
