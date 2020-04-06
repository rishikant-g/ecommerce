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
        $address = Auth::user()->addresses()->orderBy('created_at','DESC')->first();
    
        return view('Customer.customer-billing')->with('carts',$data)->with('detail',$address);
    }

    public function processCheckout(\App\Http\Requests\StoreCustomerAddress $request)
    {
        $request->validated();
        try{
        $request['user_id'] = Auth::user()->id;
        Address::create($request->all());
        return view('Shop.pay');
        }catch(\Exception $ex){
            dd($ex);
        }
        // return redirect()->route('showpaymentpage');
    }

    // public function showPaymentPage()
    // {
    //     return view('Shop.pay');
    // }
}
